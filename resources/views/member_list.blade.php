@extends('layouts.app')

@section('title', 'Orodha ya Washiriki')
@endsection

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@if (session('errors'))
    <div class="alert alert-danger" role="alert">
        {{ session('errors') }}
    </div>
@endif
<x-card>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm mb-2">
                <x-search />
            </div>
            <div class="col-sm-auto sm:text-right">
                <button class="btn btn-primary btn-sm btn-round has-ripple" data-toggle="modal"
                    data-target="#add-class-modal"><i class="feather icon-plus"></i> Add Class</button>
            </div>
        </div>
    </x-slot>
    <div class="table-responsive" style="overflow-y: scroll; max-height: 450px;">
        <table id="report-table" class="table table-bordered table-striped mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>JINA KAMILI</th>
                    <th>NAMBA YA UTAMBULISHO</th>
                    <th>CHUO/RAIA</th>
                    <th>NAMBA YA SIMU YA MSHIRIKI</th>
                    <th>NAMBA YA SIMU YA NYUMBANI</th>
                    <th class="text-right"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $index => $member)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $member->fullname }}</td>
                        <td>{{ $member->id_number }}</td>
                        <td>{{ $member->university }}</td>
                        <td>{{ $member->phone1 }}</td>
                        <td>{{ $member->phone2 }}</td>
                        <td>{{ $member->amount }}</td>
                        <td>{{ $member->type }}</td>
                        <td class="text-right">
                            <a href="#!" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#edit-class-modal-{{ $member->id }}"><i
                                    class="feather icon-edit"></i>&nbsp;Edit </a>
                            <a href="#!" class="btn btn-danger btn-sm"
                                onclick="if(confirm('Are you sure want to delete {{ $member->fullname }}?')) document.getElementById('destroy-class-{{ $class->id }}').submit()"><i
                                    class="feather icon-trash-2"></i>&nbsp;Delete </a>
                            <form id="destroy-class-{{ $member->id }}" method="post"
                                action="{{ route('delete_member', $member) }}">@csrf @method('delete')</form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No members yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {!! $classes->links() !!}
</x-card>

@endsection
