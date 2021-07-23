<h1>Data Mahasiswa</h1>
<table>
  <thead>
     <tr>
       <th>Nama Depan</th>
       <th>Nama Belakang</th>
       <th>Jenis Kelamin</th>
       <th>Agama</th>
       <th>Alamat</th>
       <th>Nilai</th>
     </tr>
  </thead>
  <tbody>
      @foreach($siswa as $s)
        <tr>
          <td>{{$s->nama_depan}}</td>
          <td>{{$s->nama_belakang}}</td>
          <td>{{$s->jenis_kelamin}}</td>
          <td>{{$s->agama}}</td>
          <td>{{$s->alamat}}</td>
          <td>{{$s->rataRataNilai()}}</td>
        </tr>
      @endforeach
  </tbody>
</table>