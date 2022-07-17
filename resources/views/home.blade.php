@extends('layouts.app')

{{-- Title --}}
@section('page_name') Homepage @endsection

{{-- Header Info --}}
@section('header-info')
    <h1>{{App\Models\Setting::first()->name}}</h1>
    <!-- Social Links -->
    <ul class="list-unstyled">
        <li>
            <!-- Github -->
            <a href="{{App\Models\Setting::first()->github_url}}" target="_blank">
                <i class="fab fa-github"></i>
            </a>
        </li>
        <li>
            <!-- Linkin -->
            <a href="{{App\Models\Setting::first()->linkedin_url}}" target="_blank">
                <i class="fab fa-linkedin"></i>
            </a>
        </li>
    </ul>
@endsection

{{-- Content --}}
@section('content')
<!-- Homepage -->
<section class="homepage section">
    <!-- Container -->
    <div class="container">
        <!-- Some Tags -->
        <div class="some-tags pt-4">
            <ul class="list-unstyled animate__animated animate__fadeInLeft animate__delay-1s">
                @foreach ($tags as $tag)
                    <li>
                        <a href="{{route("front.tags.show", ["id" => $tag->id])}}">
                            {{"#".$tag->name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- ./some-tags -->

        <!-- Articles Content -->
        <div class="articles-content">
            @if ($articles->count() > 0)
                <div class="row">
                    @foreach ($articles as $article)
                        <div class="col-12 col-md-4 mb-4">
                            <!-- card -->
                            <div class="card card-article animate__animated animate__backInUp animate__delay-1s">
                                @if ($article->image)
                                    <!-- Card Header -->
                                    <div class="card-header p-0">
                                        <img src="{{asset("uploads/articles/" . $article->image)}}"
                                            alt="Image article">
                                    </div>
                                    <!-- ./card-header -->
                                @endif

                                <!-- Card body -->
                                <div class="card-body">
                                    <!-- Tags -->
                                    <ul class="list-unstyled">
                                        @if ($article->tags()->count() > 0)
                                            @foreach ($article->tags as $index => $tag)
                                                <li>
                                                    <a href="{{route("front.tags.show", ["id" => $tag->id])}}">{{"#".$tag->name}}</a>
                                                </li>
                                                @if ($index == 2)
                                                    @php
                                                        break;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                    <!-- ./tags -->

                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#articleShow{{$article->id}}">
                                        <h2>{{$article->name}}</h2>
                                    </a>
                                    <div class="info">
                                        <p class="m-0">{{$article->full_text}}</p>
                                        @if (strlen($article->full_text)> 13)
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#articleShow{{$article->id}}">
                                                Show More
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <!-- ./card-body -->
                                <!-- Card Footer -->
                                <div class="card-footer d-flex align-items-center">
                                    <!-- Image -->
                                    <div class="image">
                                        <img class="img-fluid" src="{{asset("uploads/users/". $article->user->image)}}"
                                            alt="User avatar" width="30px">
                                    </div>
                                    <!-- Card Footer -->
                                    <div class="user-info">
                                        <a href="#">{{$article->user->name}}</a>
                                    </div>
                                </div>
                                <!-- ./card-footer -->
                            </div>
                            <!-- ./card -->
                            <!-- Show article Modal -->
                            <div class="modal modal-article fade text-left" id="articleShow{{$article->id}}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <!-- model dialog -->
                                <div class="modal-dialog">
                                    <!-- model dialog -->
                                    <div class="modal-content">
                                        <!-- model header -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">{{$article->name . "'s"}}</h5>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <!-- ./model-header -->

                                        <!-- model body -->
                                        <div class="modal-body">
                                            @if ($article->image)
                                                <!-- Article Image -->
                                                <div class="article-image">
                                                    <img class="img-fluid" src="{{asset("uploads/articles/" . $article->image)}}" alt="Article Image">
                                                </div>
                                            @endif

                                            <!-- Article Description -->
                                            <div class="description">
                                                <p class="m-0">{{$article->full_text}}</p>
                                            </div>
                                            <!-- Tags -->
                                            <div class="tags-content">
                                                @if ($article->tags()->count() > 0)
                                                    @foreach ($article->tags as $tag)
                                                        <a class="btn btn-sm tag-btn" href="{{route("front.tags.show", ["id" => $tag->id])}}">
                                                            {{"#".$tag->name}}
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </div>

                                        </div>
                                        <!-- ./model-body -->
                                        <!-- model footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        <!-- ./model-footer -->

                                    </div>
                                        <!-- ./model-content -->
                                </div>
                                <!-- ./model-dialog -->
                            </div>
                        </div>
                    @endforeach
                <!-- /.col -->
                </div>
                <!-- /.row -->
                @if ($articles->count() <= 6)
                    <div class="row">
                        <div class="col-12 text-center">
                            <a class="btn crayons-btn btn-sm" href="{{route("front.articles.index")}}">
                                All Articles
                            </a>
                        </div>
                    </div>
                @endif
            @else
                <div class="row">
                    <div class="col-12 m-auto">
                        <!-- Empty -->
                        <div class="empty">
                            <!-- Image -->
                            <div class="image">
                                <img src="{{asset("images/empty.svg")}}" alt="">
                            </div>
                            <!-- End of Image -->
                            <!-- Info -->
                            <div class="info ">
                                <p>No Record Found</p>
                            </div>
                        </div>
                        <!-- End of Empty -->
                    </div>
                </div>
            @endif


        </div>
        <!-- ./articles-content -->
    </div>
    <!-- ./container -->
</section>
<!-- ./homepage -->
@endsection
