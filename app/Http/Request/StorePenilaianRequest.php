<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class StorePenilaianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'mhs_nama' => ['required'],
            'pnl_periode' => ['required'],
            'pnl_pengetahuan_kerja' => ['required'],
            'pnl_kualitas_kerja' => ['required'],
            'pnl_kecepatan_kerja' => ['required'],
            'pnl_sikap_perilaku' => ['required'],
            'pnl_kreatifitas_kerja_sama' => ['required'],
            'pnl_leadership' => ['required'],
            'pnl_penanganan_masalah' => ['required'],
            'pnl_beradaptasi' => ['required'],
            'pnl_ulasan' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'mhs_nama.required' => 'Nama harus diisi.',
            'pnl_periode.required' => 'Periode harus diisi.',
            'pnl_pengetahuan_kerja.required' => 'Nama harus diisi.',
            'pnl_kualitas_kerja.required' => 'Nama harus diisi.',
            'pnl_kecepatan_kerja.required' => 'Nama harus diisi.',
            'pnl_sikap_perilaku.required' => 'Nama harus diisi.',
            'pnl_kreatifitas_kerja_sama.required' => 'Nama harus diisi.',
            'pnl_leadership.required' => 'Nama harus diisi.',
            'pnl_penanganan_masalah.required' => 'Nama harus diisi.',
            'pnl_beradaptasi.required' => 'Nama harus diisi.',
            'pnl_ulasan.required' => 'Nama harus diisi.',
        ];

    }
}