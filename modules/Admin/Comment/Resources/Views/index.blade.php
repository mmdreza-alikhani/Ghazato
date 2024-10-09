@extends('admin.layouts.master')
@section('title')
    نظرات (نیاز به تایید)
@endsection
@php
    $active_parent = 'comments';
    $active_child = 'manageComments';
@endphp
@section('content')
    <main class="bmd-layout-content">
        <div class="container-fluid">
            <div class="row  m-1 pb-4 mb-3">
                <div class="col-xs-12  col-sm-12  col-md-12  col-lg-12 p-2">
                    <div class="page-header breadcrumb-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title text-left-rtl">
                                    <div class="d-inline">
                                        <h3 class="lite-text">پنل مدیریت</h3>
                                        <span class="lite-text">نظرات</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active">نظرات (نیاز به تایید)</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shade pt-5">
                <div>
                    @if($comments->isEmpty())
                        <div class="alert alert-danger" style="margin: 5px">
                            نظری یافت نشد!
                        </div>
                    @else
                        <table class="table text-center table-responsive-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">کاربر</th>
                                <th scope="col">پست غذا</th>
                                <th scope="col">ریپلای</th>
                                <th scope="col">تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $key => $comment)
                                <tr>
                                    <th>
                                        {{ $comments->firstItem() + $key }}
                                    </th>
                                    <td style="text-align: -webkit-center">
                                        <a class="text-center" href="{{ url('/management/usersSearch?keyword=' . $comment->user->username ) }}">
                                            {{ $comment->user->username }}
                                        </a>
                                    </td>
                                    <td style="text-align: -webkit-center">
                                        <a class="text-center" href="{{ url('/management/foodsSearch?keyword=' . $comment->food->title ) }}">
                                            {{ $comment->food->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge f-{{ $comment->getRawOriginal('reply_of') ?  'main' : 'warning' }}">
                                            {{ $comment->is_reply }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown base show" style="max-width: fit-content; margin: 0 auto">
                                            <a class="btn outlined o-light c-light f-white dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                                                <i class="fas fa-cogs"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <button type="button" data-target="#showComment-{{ $comment->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    نمایش
                                                </button>
                                                <button type="button" data-target="#rejectComment-{{ $comment->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    رد کردن
                                                </button>
                                                <button type="button" data-target="#deleteComment-{{ $comment->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    حذف
                                                </button>
                                            </div>
                                        </div>
                                    </td>

                                    <div class="modal w-lg fade light blur" id="showComment-{{ $comment->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">نمایش نظر: </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('sections.errors', ['errors' => $errors->showComment])
                                                    <form action="{{ route('admin.comments.approve' , ['comment' => $comment->id]) }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="form-group col-12 col-lg-12">
                                                                <label for="text">متن نظر:*</label>
                                                                <textarea class="form-control" id="text" name="text" disabled>{{ $comment->text }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="created_at">زمان ایجاد:*</label>
                                                            <input id="created_at" type="text" value="{{ verta($comment->created_at) }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="updated_at">زمان ایجاد آخرین تغییر:*</label>
                                                            <input id="updated_at" type="text" value="{{ verta($comment->updated_at) }}" class="form-control" disabled>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn outlined f-main">تایید</button>
                                                    <button type="button" class="btn outlined o-danger c-danger" data-dismiss="modal">بستن</button>
                                                </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                    @if(count($errors->showComment) > 0)
                                        <script>
                                            $('#showComment-{{ session()->get('comment_id') }}').modal({
                                                show: true
                                            });
                                        </script>
                                    @endif

                                    <div class="modal w-lg fade light blur" id="rejectComment-{{ $comment->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">رد نظر: </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('sections.errors', ['errors' => $errors->rejectComment])
                                                    <form action="{{ route('admin.comments.reject' , ['comment' => $comment->id]) }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="form-group col-12 col-lg-12">
                                                                <label for="text">متن نظر:*</label>
                                                                <textarea class="form-control" id="text" name="text">{{ $comment->text }}</textarea>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="text">علت رد کردن:*</label>
                                                                <select id="reason_for_rejection" class="form-control" name="reason_for_rejection">
                                                                    <option value="توهین و ناسزا">توهین و ناسزا</option>
                                                                    <option value="نامربوط بودن">نامربوط بودن</option>
                                                                    <option value="توهین قومیتی و دینی">توهین قومیتی و دینی</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn outlined f-main">رد کردن</button>
                                                    <button type="button" class="btn outlined o-danger c-danger" data-dismiss="modal">بستن</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @if(count($errors->rejectComment) > 0)
                                        <script>
                                            $('#rejectComment-{{ session()->get('comment_id') }}').modal({
                                                show: true
                                            });
                                        </script>
                                    @endif

                                    <div class="modal w-lg fade justify " id="deleteComment-{{ $comment->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف نظر: </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا از حذف این نظر اطمینان دارید؟
                                                </div>
                                                <form action="{{ route('admin.comments.destroy', ['comment' => $comment]) }}" method="POST">
                                                    <div class="modal-footer">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="button" class="btn outlined o-main c-main" data-dismiss="modal">بازگشت</button>
                                                        <button type="submit" class="btn outlined f-danger">حذف</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $comments->links() }}
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
