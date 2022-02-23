@extends('layouts.app')

@section('content')
    <section id="members">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-primary" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('errors'))
                <div class="alert alert-success" role="alert">
                    {{ session('errors') }}
                </div>
            @endif
            <div class="card">
                <div class="px-3 py-2">
                    <div class="row">
                        <div class="col-sm-4 text-left">
                            <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#uploadFileModal">
                                <i class="fas fa-plus"></i> Sajili Wengi
                            </a>
                        </div>
                        <div class="col-sm-4 text-center">
                            <h4>WASHIRIKI ({{ count($members) }})</h4>
                        </div>
                        <div class="col-sm-4 text-right">
                            <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#addMemberModal">
                                <i class="fas fa-plus"></i> Sajili
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-responsive-lg">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>JINA KAMILI</th>
                            <th>ID #</th>
                            <th>CHUO</th>
                            <th>SIMU (SELF)</th>
                            <th>SIMU (HOME)</th>
                            <th class="text-center">KIASI</th>
                            <th>MALIPO</th>

                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $index => $member)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $member->fullname }}</td>
                                <td>{{ $member->id_number }}</td>
                                <td>{{ $member->university }}</td>
                                <td>{{ $member->phone1 }}</td>
                                <td>{{ $member->phone2 }}</td>
                                <td class="text-right">{{ number_format($member->amount, 0) }} Tsh</td>
                                <td>{{ $member->type }}</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#editMemberModal-{{ $member->id }}">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <div class="modal fade" id="editMemberModal-{{ $member->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success text-white">
                                                    <h5 class="modal-title">Rekebisha Taarifa za Mshiriki</h5>
                                                    <button class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('edit_member', $member->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row mb-3">
                                                            <label for="fullname"
                                                                class="col-md-4 col-form-label text-md-end">{{ __('Jina Kamili') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="fullname" type="text"
                                                                    class="form-control @error('fullname') is-invalid @enderror"
                                                                    name="fullname"
                                                                    value="{{ old('fullname', $member->fullname) }}"
                                                                    required autocomplete="name" autofocus>

                                                                @error('fullname')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="id_number"
                                                                class="col-md-4 col-form-label text-md-end">{{ __('Namba ya Utambulisho') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="id_number" type="text"
                                                                    class="form-control @error('id_number') is-invalid @enderror"
                                                                    name="id_number"
                                                                    value="{{ old('id_number', $member->id_number) }}"
                                                                    required autocomplete="id_number">

                                                                @error('id_number')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="type"
                                                                class="col-md-4 col-form-label text-md-end">{{ __('Jina la Chuo/Raia') }}</label>

                                                            <div class="col-md-6">
                                                                <select id="university" required name="university"
                                                                    class=" form-control @error('university') is-invalid @enderror dropdown-select form-control"
                                                                    autocomplete="university">
                                                                    <option value="ARU">
                                                                        {{ $member->university == 'ARU' ? 'selected' : '' }}ARU
                                                                    </option>
                                                                    <option value="DIT"
                                                                        {{ $member->university == 'DIT' ? 'selected' : '' }}>
                                                                        DIT</option>
                                                                    <option value="DUCE"
                                                                        {{ $member->university == 'DUCE' ? 'selected' : '' }}>
                                                                        DUCE</option>
                                                                    <option value="EASTC"
                                                                        {{ $member->university == 'EASTC' ? 'selected' : '' }}>
                                                                        EASTC</option>
                                                                    <option value="EX MSAUD"
                                                                        {{ $member->university == 'EX MSAUD' ? 'selected' : '' }}>
                                                                        EX MSAUD</option>
                                                                    <option value="MNMA"
                                                                        {{ $member->university == 'MNMA' ? 'selected' : '' }}>
                                                                        MNMA</option>
                                                                    <option value="MUM"
                                                                        {{ $member->university == 'MUM' ? 'selected' : '' }}>
                                                                        MUM</option>
                                                                    <option value="MUST"
                                                                        {{ $member->university == 'MUST' ? 'selected' : '' }}>
                                                                        MUST</option>
                                                                    <option value="NIT"
                                                                        {{ $member->university == 'NIT' ? 'selected' : '' }}>
                                                                        NIT</option>
                                                                    <option value="RAIA"
                                                                        {{ $member->university == 'RAIA' ? 'selected' : '' }}>
                                                                        RAIA</option>
                                                                    <option value="SUA"
                                                                        {{ $member->university == 'SUA' ? 'selected' : '' }}>
                                                                        SUA</option>
                                                                    <option value="SUZA"
                                                                        {{ $member->university == 'SUZA' ? 'selected' : '' }}>
                                                                        SUZA</option>
                                                                    <option value="TIA"
                                                                        {{ $member->university == 'TIA' ? 'selected' : '' }}>
                                                                        TIA</option>
                                                                    <option value="UDSM"
                                                                        {{ $member->university == 'UDSM' ? 'selected' : '' }}>
                                                                        UDSM</option>
                                                                </select>
                                                                @error('university')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="phone1"
                                                                class="col-md-4 col-form-label text-md-end">{{ __('Namba ya Simu ya Mshiriki') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="phone1" type="telephone"
                                                                    class="form-control @error('phone1') is-invalid @enderror"
                                                                    name="phone1"
                                                                    value="{{ old('phone1', $member->phone1) }}" required
                                                                    autocomplete="phone">

                                                                @error('phone1')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="phone2"
                                                                class="col-md-4 col-form-label text-md-end">{{ __('Namba ya Simu ya Nyumbani') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="phone2" type="telephone"
                                                                    class="form-control @error('phone2') is-invalid @enderror"
                                                                    name="phone2"
                                                                    value="{{ old('phone2', $member->phone2) }}" required
                                                                    autocomplete="phone">

                                                                @error('phone2')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="amount"
                                                                class="col-md-4 col-form-label text-md-end">{{ __('Kiasi') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="amount" type="number"
                                                                    class="form-control @error('amount') is-invalid @enderror"
                                                                    name="amount"
                                                                    value="{{ old('amount', $member->amount) }}" required
                                                                    autocomplete="amount">

                                                                @error('amount')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="type"
                                                                class="col-md-4 col-form-label text-md-end">{{ __('Mfumo wa Malipo') }}</label>

                                                            <div class="col-md-6">
                                                                <select id="type" required name="type"
                                                                    class=" form-control @error('type') is-invalid @enderror dropdown-select form-control"
                                                                    autocomplete="type">
                                                                    <option value="CASH"
                                                                        {{ $member->type == 'CASH' ? 'selected' : '' }}>
                                                                        CASH</option>
                                                                    <option value="PHONE"
                                                                        {{ $member->type == 'PHONE' ? 'selected' : '' }}>
                                                                        PHONE</option>

                                                                </select>
                                                                @error('type')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-0 text-center">
                                                            <div class="">
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('SAJILI') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('delete_member', $member->id) }}"
                                        onclick="return confirm('This category will be deleted')"
                                        class="btn btn-outline-danger">
                                        <i class="fas fa-trash"> </i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!-- ADD MEMBER MODAL -->
        <div class="modal fade" id="addMemberModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Sajili Mshiriki</h5>
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('add_member') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="fullname"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Jina Kamili') }}</label>

                                <div class="col-md-6">
                                    <input id="fullname" type="text"
                                        class="form-control @error('fullname') is-invalid @enderror" name="fullname"
                                        value="{{ old('fullname') }}" required autocomplete="name" autofocus>

                                    @error('fullname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="id_number"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Namba ya Utambulisho') }}</label>

                                <div class="col-md-6">
                                    <input id="id_number" type="text"
                                        class="form-control @error('id_number') is-invalid @enderror" name="id_number"
                                        value="{{ old('id_number') }}" required autocomplete="id_number">

                                    @error('id_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="type"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Jina la Chuo/Raia') }}</label>

                                <div class="col-md-6">
                                    <select id="university" required name="university"
                                        class=" form-control @error('university') is-invalid @enderror dropdown-select form-control"
                                        autocomplete="university">
                                        <option value="">Chuo au Raia</option>
                                        <option value="ARU">ARU</option>
                                        <option value="DIT">DIT</option>
                                        <option value="DUCE">DUCE</option>
                                        <option value="EASTC">EASTC</option>
                                        <option value="EX MSAUD">EX MSAUD</option>
                                        <option value="MNMA">MNMA</option>
                                        <option value="MUM">MUM</option>
                                        <option value="MUST">MUST</option>
                                        <option value="NIT">NIT</option>
                                        <option value="RAIA">RAIA</option>
                                        <option value="SUA">SUA</option>
                                        <option value="SUZA">SUZA</option>
                                        <option value="TIA">TIA</option>
                                        <option value="UDSM">UDSM</option>
                                    </select>
                                    @error('university')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phone1"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Namba ya Simu ya Mshiriki') }}</label>

                                <div class="col-md-6">
                                    <input id="phone1" type="telephone"
                                        class="form-control @error('phone1') is-invalid @enderror" name="phone1"
                                        value="{{ old('phone1') }}" required autocomplete="phone">

                                    @error('phone1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phone2"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Namba ya Simu ya Nyumbani') }}</label>

                                <div class="col-md-6">
                                    <input id="phone2" type="telephone"
                                        class="form-control @error('phone2') is-invalid @enderror" name="phone2"
                                        value="{{ old('phone2') }}" required autocomplete="phone">

                                    @error('phone2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="amount"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Kiasi') }}</label>

                                <div class="col-md-6">
                                    <input id="amount" type="number"
                                        class="form-control @error('amount') is-invalid @enderror" name="amount"
                                        value="{{ old('amount') }}" required autocomplete="amount">

                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="type"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Mfumo wa Malipo') }}</label>

                                <div class="col-md-6">
                                    <select id="type" required name="type"
                                        class=" form-control @error('type') is-invalid @enderror dropdown-select form-control"
                                        autocomplete="type">
                                        <option value="">Cash au Phone</option>
                                        <option value="CASH">CASH</option>
                                        <option value="PHONE">PHONE</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0 text-center">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('SAJILI') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- UPLOAD FILE MODAL -->
        <div class="modal fade" id="uploadFileModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Sajili Mshiriki</h5>
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('file_import') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="import_file"
                                    class="col-md-4 col-form-label text-md-right">{{ __('File la Washiriki') }}</label>
                                <div class="col-md-6">
                                    <input id="import_file" type="file"
                                        class="form-control @error('import_file', 'bulk') is-invalid @enderror"
                                        name="import_file" required>
                                    <span class="form-group">.csv, .xlsx</span>
                                    @error('import_file', 'bulk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0 text-center">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('SAJILI') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
