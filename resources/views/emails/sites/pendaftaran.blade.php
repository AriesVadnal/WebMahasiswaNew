@component('mail::message')
# Pendaftaran Siswa Baru

Selamat Anda Telah terdaftar di sekolah kami

@component('mail::button', ['url' => 'http://rolloic.com'])
Klik Disini
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
