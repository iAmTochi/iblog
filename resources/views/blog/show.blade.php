@extends('layouts.blog')


@section('title')

    {{ $post->title }}

@endsection


@section('header')

    <header class="header text-white h-fullscreen pb-80" style="background-image: url({{ asset('storage/'.$post->image) }});" data-overlay="9">
        <div class="container text-center">

            <div class="row h-100">
                <div class="col-lg-8 mx-auto align-self-center">

                    <p class="opacity-70 text-uppercase small ls-1">{{ $post->category->name }}</p>
                    <h1 class="display-4 mt-7 mb-8">{{ $post->title }}</h1>
                    <p><span class="opacity-70 mr-1">By</span> <a class="text-white" href="#">{{ $post->user->name }}</a></p>
                    <p><img class="avatar avatar-sm" src="{{ Gravatar::src($post->user->email) }}" alt="..."></p>

                </div>

                <div class="col-12 align-self-end text-center">
                    <a class="scroll-down-1 scroll-down-white" href="#section-content"><span></span></a>
                </div>

            </div>

        </div>
    </header>

@endsection


@section('content')

    <main class="main-content">


        <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Blog content
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        <div class="section" id="section-content">
            <div class="container">

                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        {!! $post->content !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 mx-auto">

                        <div class="gap-xy-2 mt-6">

                            @foreach($post->tags as $tag)
                            <a class="badge badge-pill badge-secondary" href="#">{{ $tag->name }}</a>
                            @endforeach
                        </div>

                    </div>
                </div>


            </div>
        </div>



        <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Comments
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        <div class="section bg-gray">
            <div class="container">

                <div class="row">
                    <div class="col-lg-8 mx-auto">

                        <div class="media-list">

                            <div class="media">
                                <img class="avatar avatar-sm mr-4" src="../assets/img/avatar/1.jpg" alt="...">

                                <div class="media-body">
                                    <div class="small-1">
                                        <strong>Maryam Amiri</strong>
                                        <time class="ml-4 opacity-70 small-3" datetime="2018-07-14 20:00">24 min ago</time>
                                    </div>
                                    <p class="small-2 mb-0">Thoughts his tend and both it fully to would the their reached drew project the be I hardly just tried constructing I his wonder, that his software and need out where didn't the counter productive.</p>
                                </div>
                            </div>



                            <div class="media">
                                <img class="avatar avatar-sm mr-4" src="../assets/img/avatar/2.jpg" alt="...">

                                <div class="media-body">
                                    <div class="small-1">
                                        <strong>Hossein Shams</strong>
                                        <time class="ml-4 opacity-70 small-3" datetime="2018-07-14 20:00">6 hours ago</time>
                                    </div>
                                    <p class="small-2 mb-0">Was my suppliers, has concept how few everything task music.</p>
                                </div>
                            </div>



                            <div class="media">
                                <img class="avatar avatar-sm mr-4" src="../assets/img/avatar/3.jpg" alt="...">

                                <div class="media-body">
                                    <div class="small-1">
                                        <strong>Sarah Hanks</strong>
                                        <time class="ml-4 opacity-70 small-3" datetime="2018-07-14 20:00">Yesterday</time>
                                    </div>
                                    <p class="small-2 mb-0">Been me have the no a themselves, agency, it that if conduct, posts, another who to assistant done rattling forth there the customary imitation.</p>
                                </div>
                            </div>

                        </div>


                        <hr>




                        <div id="disqus_thread"></div>
                        <script>

                            /**
                             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

                            var disqus_config = function () {
                                this.page.url = "{{ config('app.url') }}/blog/posts/{{ $post->id }}";  // Replace PAGE_URL with your page's canonical URL variable
                                this.page.identifier = "{{ $post->id }}" ; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                            };

                            (function() { // DON'T EDIT BELOW THIS LINE
                                var d = document, s = d.createElement('script');
                                s.src = 'https://iblog-2.disqus.com/embed.js';
                                s.setAttribute('data-timestamp', +new Date());
                                (d.head || d.body).appendChild(s);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

                    </div>
                </div>

            </div>
        </div>



    </main>

@endsection
