@extends('admin.rubrique')

@section('main-content')
    @if(session('success'))
        <div class="alert alert-success">
            <p class="text-light">{{session('success')}}</p>
        </div>
    @endif

    <div class="d-flex gap-2">
        <a class="btn btn-primary" href="{{ route('category.create') }}" role="button">Ajouter</a>
        <a class="btn btn-info" href="{{ route('category.deleted') }}" role="button">Catégorie supprimée</a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">List de toutes les categories</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Modification</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($category->image ? $category->image->path : '') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                        </td>
                                        <td>
                                            <h6 class="mb-0 text-sm">{{ $category->name }}</h6>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{ $category->deleted_at == null ? 'OnLine' : 'OnffLine' }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ date('d/m/Y à H:m:s', strtotime($category->updated_at)) }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex gap-2 w-100 justify-content-end">
                                                @if(!$category->trashed())
                                                    <a href="{{route('category.edit', $category)}}" class="btn btn-primary" data-toggle="tooltip" data-original-title="Edit user">
                                                        Editer
                                                    </a>
                                                    <form action="{{ route('category.destroy', $category) }}" method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <button class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('category.restore', $category) }}" class="btn btn-success">Restaurer</a>
                                                    <a href="{{ route('category.remove', $category) }}" class="btn btn-danger">Supprimer définitivement</a>
                                                @endif
                                            </div>

                                            {{--<a href="javascript:;" class="text-secondary font-weight-bold text-xs m-2" data-toggle="tooltip" data-original-title="Edit user">

                                            </a>--}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Projects table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Budget</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Completion</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <div>
                                            <img src="assets/img/small-logos/logo-asana.svg" class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                        </div>
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">Asana</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">$2,500</p>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-bold">working</span>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">60%</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-link text-secondary mb-0">
                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <div>
                                            <img src="assets/img/small-logos/github.svg" class="avatar avatar-sm rounded-circle me-2" alt="invision">
                                        </div>
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">Github</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">$5,000</p>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-bold">done</span>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">100%</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <div>
                                            <img src="assets/img/small-logos/logo-atlassian.svg" class="avatar avatar-sm rounded-circle me-2" alt="jira">
                                        </div>
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">Atlassian</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">$3,400</p>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-bold">canceled</span>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">30%</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30" style="width: 30%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <div>
                                            <img src="assets/img/small-logos/bootstrap.svg" class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                                        </div>
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">Bootstrap</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">$14,000</p>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-bold">working</span>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">80%</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width: 80%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <div>
                                            <img src="assets/img/small-logos/logo-slack.svg" class="avatar avatar-sm rounded-circle me-2" alt="slack">
                                        </div>
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">Slack</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">$1,000</p>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-bold">canceled</span>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">0%</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: 0%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <div>
                                            <img src="assets/img/small-logos/devto.svg" class="avatar avatar-sm rounded-circle me-2" alt="xd">
                                        </div>
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">Devto</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">$2,300</p>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-bold">done</span>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">100%</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
@endsection

@section('scripts')
    @parent
@endsection
