@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Редактировать оператора</div>
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Управление сайтом</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Редактировать оператора</li>
				  </ol>
				</nav>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
					<form method="POST" action="{{ route('admin.updateOperator', ['id' => $operator->id]) }}">
                       @csrf
                       @method('PATCH')
                       <input type="hidden" name="id" value="{{ $operator->id }}">
                       <div class="form-group row">
                           <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                           <div class="col-md-6">
                               <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $operator->name }}" required autocomplete="name" autofocus>

                               @error('name')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                           </div>
                       </div>

                       <div class="form-group row">
                           <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail адрес') }}</label>

                           <div class="col-md-6">
                               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $operator->email }}" required autocomplete="email">

                               @error('email')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                           </div>
                       </div>

                       <div class="form-group row">
                           <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                           <div class="col-md-6">
                               <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                               @error('password')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                           </div>мин. 8 символов
                       </div>

                       <div class="form-group row">
                           <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Подтвердить пароль') }}</label>

                           <div class="col-md-6">
                               <input id="password-confirm" type="text" class="form-control" name="password_confirmation" required autocomplete="new-password">
                           </div>мин. 8 символов
                       </div>

                       <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Редактировать оператора') }}
                                </button>
                            </div>
                        </div>
                    </form>
	       		</div>
	   		</div>
		</div>
	</div>
@endsection