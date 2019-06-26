@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Управление сайтом</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Администраторы</h4>
                            <ul class="list-group list-group-flush">
                                @foreach($admins as $admin)
                                    <li class="list-group-item">{{ $admin->email }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="container">
                                
                                <div class="row">
                                    <div class="col-md-8"><h4>Операторы</h4></div>
                                    <div class="col-md-4">
                                        <a href="{{ route('admin.NewOperator') }}">
                                            <button type="button" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <ul class="list-group list-group-flush">
                                @foreach($operators as $operator)

                                    <li class="list-group-item">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h6>Имя: </h6> {{$operator->name}}
                                                    <h6>Email: </h6> {{ $operator->email }}
                                                </div>
                                    
                                                <div class="col-md-4">

                                                    <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-toggle="modal" data-target=".delete-modal{{$operator->id}}">
                                                            <i class="fa fa-trash"></i>
                                                    </button>
                                                    <a href="{{ route('admin.editOperator', ['id' => $operator->id]) }}">
                                                        <button class="btn btn-sm btn-primary" type="button">
                                                                <i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                    </li>
                                    {{-- MODAL FOR DELETING --}}
                                   <div class="modal fade delete-modal{{$operator->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content p-5">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Удаление {{ $operator->email }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <p><span style="font-size: 15px; font-weight: bold;">Вы действительно хотите удалить оператора ? </span></p>
                                            <p> ID: {{ $operator->id }} </p>
                                            <p> EMAIL: {{ $operator->email }} </p>
                                            <p> Имя: {{ $operator->name }} </p>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                                            <form method="POST" action="{{ route('admin.destroyOperator', ['id' => $operator->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $operator->id }}">
                                                <button type="submit" class="btn btn-primary">Подтвердить удаление</button>
                                            </form>
                                          </div>
                                        </div>
                                    </div>
                                    </div>

                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h4>Клиенты</h4>
                            <ul class="list-group list-group-flush">
                                @foreach($clients as $client)
                                    <li class="list-group-item">{{ $client->email }}</li>
                                @endforeach
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
