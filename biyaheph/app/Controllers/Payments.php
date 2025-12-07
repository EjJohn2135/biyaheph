<?php
 namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\PaymentModel;

class Payments extends BaseController
{
    // Keep this for POST-based session creation if needed
    public function createSession()
    {
        $bookingId = $this->request->getPost('booking_id');
        return $this->createStripeSessionAndRedirect($bookingId);
    }

    // New: allow GET checkout so Bookings->store redirect works
    public function checkout()
    {
        $bookingId = $this->request->getGet('booking_id');
        return $this->createStripeSessionAndRedirect($bookingId);
    }

    protected function createStripeSessionAndRedirect($bookingId)
    {
        $booking = (new BookingModel())->find($bookingId);
        if (!$booking) return $this->response->setStatusCode(404)->setJSON(['error'=>'Booking not found']);

        \Stripe\Stripe::setApiKey(env('stripe.secret'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'php',
                    'product_data' => [
                        'name' => "Booking #{$bookingId}",
                    ],
                    'unit_amount' => (int)($booking['total'] * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => site_url('payments/success?session_id={CHECKOUT_SESSION_ID}&booking_id='.$bookingId),
            'cancel_url' => site_url('payments/cancel?booking_id='.$bookingId)
        ]);

        return redirect()->to($session->url);
    }

    public function success()
    {
        $sessionId = $this->request->getGet('session_id');
        $bookingId = $this->request->getGet('booking_id');

        \Stripe\Stripe::setApiKey(env('stripe.secret'));
        $session = \Stripe\Checkout\Session::retrieve($sessionId);
        $paymentIntent = $session->payment_intent;

        // Save payment record
        $paymentModel = new PaymentModel();
        $paymentModel->insert([
            'booking_id' => $bookingId,
            'stripe_payment_id' => $paymentIntent,
            'amount' => $session->amount_total / 100,
            'currency' => $session->currency,
            'status' => 'paid'
        ]);

        // mark booking as paid
        $bookingModel = new BookingModel();
        $bookingModel->update($bookingId, ['status' => 'paid']);

        return view('payments/success', ['session' => $session]);
    }

    public function cancel()
    {
        $bookingId = $this->request->getGet('booking_id');
        // mark pending or cancelled
        (new BookingModel())->update($bookingId, ['status' => 'cancelled']);
        return view('payments/cancel');
    }
}