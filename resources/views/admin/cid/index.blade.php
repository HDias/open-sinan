@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="card mb-4 card-shadow-6">
            <div class="card-header">

                <h5 class="title d-inline"><strong>Lista</strong> de CIDs</h5>

                <div class="pull-right">

                    @shield('cid.create')
                        <a href="{{ route('cid.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> {{ trans('forms.button_new') }}
                        </a>
                    @endshield
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">CID</th>
                            <th scope="col">Descrição</th>
                            <th class="text-center"><i class="fa fa-cog"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($resources as $data)
                            <tr class="{{ deletedAt($data->deleted_at, 1) }}">
                                <td>{!! getId($data->id, $loop->iteration) !!}</td>
                                <td>{!! $data->cid !!}</td>
                                <td>{!! $data->descricao !!}</td>
                                @if(!deletedAt($data->deleted_at, 2))
                                <td class="text-center" nowrap>

                                    @shield('cid.edit')
                                        <a href="{{ route('cid.edit', ['id' => $data->id]) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endshield

                                    @shield('cid.destroy')
                                        <nut-trash-btn href="{{ route('cid.destroy', $data->id) }}"
                                                       data-id="{{ $data->id }}">
                                        </nut-trash-btn>
                                    @endshield

                                </td>
                                @elseif (deletedAt($data->deleted_at, 1))
                                    <td class="text-center">
                                        @include('layouts.btnRestore', [
                                            'route' => route('cid.restore', ['id' => $data->id]),
                                            'model' => 'Cid'
                                        ])
                                    </td>

                                @endif
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="4">{{ trans('list.empty') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
