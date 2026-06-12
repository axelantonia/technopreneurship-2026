<?php

namespace App\Http\Controllers;

use App\Data\TutorData;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function tutorList()
    {
        $tutors = TutorData::all();
        return view('pages.tutors', compact('tutors'));
    }

    public function tutorDetail(int $id)
    {
        $tutor = TutorData::find($id);
        if (!$tutor) abort(404);
        return view('pages.tutors-detail', compact('tutor'));
    }

    public function checkout(Request $request)
    {
        $tutor = TutorData::find((int) $request->query('tutor_id'));
        if (!$tutor) abort(404);

        $matkul  = $request->query('matkul', $tutor['matkul'][0]);
        $jadwal  = $request->query('jadwal', '');
        $metode  = $request->query('metode', 'Online (GMeet / Zoom)');

        return view('pages.checkout', compact('tutor', 'matkul', 'jadwal', 'metode'));
    }

    public function confirmPayment(Request $request)
    {
        $request->validate([
            'tutor_id' => 'required|integer',
            'matkul'   => 'required|string',
            'jadwal'   => 'required|string',
            'metode'   => 'required|string',
            'total'    => 'required|integer',
            'voucher'  => 'nullable|string',
            'bukti'    => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $tutor = TutorData::find((int) $request->tutor_id);
        if (!$tutor) abort(404);

        $bookingId = 'TUT-' . strtoupper(substr(md5(uniqid()), 0, 8));

        session([
            'booking_id' => $bookingId,
            'tutor'      => $tutor,
            'matkul'     => $request->matkul,
            'jadwal'     => $request->jadwal,
            'metode'     => $request->metode,
            'total'      => (int) $request->total,
            'voucher'    => $request->voucher ?? '',
        ]);

        return redirect()->route('payment');
    }

    public function paymentStatus()
    {
        if (!session('booking_id')) return redirect()->route('tutors');

        return view('pages.payment', [
            'bookingId' => session('booking_id'),
            'tutor'     => session('tutor'),
            'matkul'    => session('matkul'),
            'jadwal'    => session('jadwal'),
            'metode'    => session('metode'),
            'total'     => session('total'),
            'voucher'   => session('voucher'),
        ]);
    }
}
