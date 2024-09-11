@extends('admin.layouts.master')
@section('title')
    پیام ها
@endsection
@php
    $active_parent = 'feedbacks';
    $active_child = 'manageFeedbacks';
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
                                        <span class="lite-text">پیام ها</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active">پیام ها</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shade pt-5">
                <div class="row mx-1">
                    <div>
                        <form action="{{ route('admin.feedback.search') }}" method="GET">
                            <input type="text" class="form-control" placeholder="جستجو بین پیام ها با موضوع" style="width: 250px" value="{{ request()->has('keyword') ? request()->keyword : '' }}" name="keyword">
                            <button type="submit" class="d-none"></button>
                        </form>
                    </div>
                </div>
                <div>
                    @if($feedbacks->isEmpty())
                        <div class="alert alert-danger" style="margin: 5px">
                            پیامی یافت نشد!
                        </div>
                    @else
                        <table class="table text-center table-responsive-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">کاربر</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($feedbacks as $key => $feedback)
                                <tr>
                                    <th>
                                        {{ $feedbacks->firstItem() + $key }}
                                    </th>
                                    <td style="text-align: -webkit-center">
                                        <a class="text-center" href="{{ url('/management/usersSearch?keyword=' . $feedback->user->username ) }}">
                                            {{ $feedback->user->username }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $feedback->subject }}
                                    </td>
                                    <td>
                                        <div class="dropdown base show" style="max-width: fit-content; margin: 0 auto">
                                            <a class="btn outlined o-light c-light f-white dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                                                <i class="fas fa-cogs"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <button type="button" data-target="#responseFeedback-{{ $feedback->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    نمایش
                                                </button>
                                                <button type="button" data-target="#deleteFeedback-{{ $feedback->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    حذف
                                                </button>
                                            </div>
                                        </div>
                                    </td>

                                    <div class="modal w-lg fade light blur" id="responseFeedback-{{ $feedback->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">پاسخ به: {{ $feedback->subject }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('sections.errors', ['errors' => $errors->responseFeedback])
                                                    <form action="{{ route('admin.feedback.response' , ['feedback' => $feedback->id]) }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="form-group col-12 col-lg-12">
                                                                <label for="text">متن پیام:*</label>
                                                                <textarea class="form-control" id="text" name="text" disabled>{{ $feedback->text }}</textarea>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-12">
                                                                <label for="response">پاسخ شما:*</label>
                                                                <textarea class="form-control" id="response" name="response" required>{{ old('response') }}</textarea>
                                                            </div>
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
                                    @if(count($errors->responseFeedback) > 0)
                                        <script>
                                            $('#responseFeedback-{{ session()->get('feedback_id') }}').modal({
                                                show: true
                                            });
                                        </script>
                                    @endif

                                    <div class="modal w-lg fade justify " id="deleteFeedback-{{ $feedback->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف: {{ $feedback->subject }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا از حذف این پیام اطمینان دارید؟
                                                </div>
                                                <form action="{{ route('admin.feedback.destroy', ['feedback' => $feedback]) }}" method="POST">
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
                        {{ $feedbacks->links() }}
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
