@extends('app')

@section('content')
<div class="container">
  <span style="flost:right">
      <a class="btn btn-default" href="{{ url('siswa/add') }}">Add New Siswa</a>
  </span>

  <table class="table table-hover">
    <thead>
      <tr>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Jurusan</th>
          <th>Tempat/Tanggal Lahir</th>
          <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $res)
      <tr>
        <td>{{ $res->nama }}</td>
        <td>{{ $res->kelas }}</td>
        <td>{{ $res->jurusan }}</td>
        <td>{{ $res->tempat_lahir }} {{ $res->tanggal_lahir }}</td>
        <td>
            <a href="{{ url('siswa/edit/'.$res->id) }}">Edit</a>
            <a onclick="return confirm('hapus?')" href="{{ url('siswa/delete/'.$res->id) }}">Delete</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
