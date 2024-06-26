@extends('dashboard.layouts.main')
@section('webtitle','Kelas')
@section('container')
<div class="section-header"><h3>Data Kelas</h3>
<div class="section-header-breadcrumb">
    @if(auth()->user()->role=='User')
    @else
    <a href="/dashboard/kelas/create" class="badge badge-primary text-decoration-none"><i class="fas fa-plus"></i>Create New Kelas</a>
    @endif
</div>
</div>
    <div class="card">
        <div class="card-body">
            <table class="table table-responsive-md" id="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Angkatan</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Nama Kelas</th>
                        <th scope="col">Instagram</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($kelas as $list )
                  <tr>
                   <td>{{ $loop->iteration }}</td>
                   <td>{{ $list->angkatan->nama }}</td>
                   <td>{{ $list->kelas }}</td>
                   <td>{{ $list->nama }}</td>
                   <td>{{ $list->instagram }}</td>
                   <td>
                    <a href="/dashboard/kelas/{{ $list->id }}" class="badge badge-info mt-1"><i class="far fa-eye"></i></a>
                       @if(auth()->user()->role=='User')
                       @else
                    <a href="/dashboard/kelas/{{ $list->id }}/edit" class="badge badge-warning mt-1"><i class="far fa-edit"></i></a>
                    <form action="/dashboard/kelas/{{ $list->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge badge-danger mt-1 border-0 deleteButton" id="delete" type="submit" data-name='{{ $list->nama }}'><i class="far fa-trash-alt"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
@section('customjs')
<script>
    $(document).ready(function() {
        $('.deleteButton').click(function (e) { 
            e.preventDefault();
            var name = $(this).attr('data-name');
            var form = $(this).closest("form");
            Swal.fire({
                title:'Apakah Anda Yakin?',
                text:'Anda akan melakukan penghapusan pada kelas '+name+' Beserta dengan seluruh user yang terkait',
                icon:"warning",
                confirmButtonText:'Ya, Hapuskan',
                showCancelButton:true,
                confirmButtonColor:'#d33',
            }).then((result)=>{
                if(result.isConfirmed){
                    Swal.fire('Deleting!','Deleting your data','info')
                    form.submit();
                }else{
                    Swal.fire('Cancelled!','Your data is safe','success')
                }
            })
        });
    });
</script>
@endsection
