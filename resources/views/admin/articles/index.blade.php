@extends('admin.layouts.admin')
@section('title','المقالات')
@section('content')
<section class="">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <li class="breadcrumb-item"><a href="#">الواجهة</a></li>
            <li href="" class="breadcrumb-item" aria-current="page">
             المقالات
            </li>
        </ol>
    </nav>
    <div class="section_content content_view">
        <div class="up_element mb-2">
            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                إضافة
                <i class="fa-solid fa-arrow-left-long"></i>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>صورة المقال</th>
                        <th>عنوان المقال  </th>
                        <th>المحتوي  </th>
                        <th class="text-nowrap">تاريخ الانشاء</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                   
                    @foreach ($articles as $article)
                    <tr>

                        <td>{{ $loop->iteration }}</td>
                        <td class="user">
                            @if ($article->image)
                                <img src="{{ display_file($article->image) }}"
                                    alt="{{ $article->title }}" width="50">
                            @else
                                <img src="{{ asset('admin-asset/img/no-image.jpg') }}" alt="{{ $article->title }}" width="50">
                            @endif
                        </td>
                        <td>{{ Illuminate\Support\Str::limit($article->title, 30) }}</td>
                        <td>

                            <button type="button" class="btn-light-blue"
                                data-bs-toggle="modal" data-bs-target="#articleModalAr{{ $article->id }}">
                                عرض المقاله  
                            </button>
                        </td>
                      
                        <td class="text-nowrap">{{ $article->created_at() }}</td>
                        <td class="">
                            <div class="d-flex align-items-center gap-3">
                                <a href="{{ route('admin.articles.edit', $article->id) }}" class="">
                                    <i class="fa-solid fa-pen text-info icon-table"></i>
                                </a>
                                <button type="button" data-bs-toggle="modal"
                                    data-bs-target="#delete{{ $article->id }}">
                                    <i class="fa-solid fa-trash text-danger icon-table"></i>
                                </button>
                                @include('admin.articles.delete-modal', ['article' => $article])
                            </div>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
            {{ $articles->links() }}
        </div>

    </div>
</section>

@foreach ($articles as $article)
<div class="modal fade" id="articleModalAr{{ $article->id }}" tabindex="-1"
    aria-labelledby="articleModalLabel{{ $article->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="articleModalLabel{{ $article->id }}">{{ $article->title }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{!!   $article->content !!}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
