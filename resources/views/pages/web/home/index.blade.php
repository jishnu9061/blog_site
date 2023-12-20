@extends('layouts.web')

@section('content')
    <div class="container">
        <strong>
            <p style="font-family:verdana,sans-serif;font-size:12px;text-align:left;background-color:BurlyWood;color:black;padding-top:10px;padding-bottom:10px;padding-left:10px;margin-top:10px;margin-bottom:20px;">
                Notes:<br><br>
                1. Please click the "View in Editor" button above, to get all the links fully working in this codepen
                project.<br>
                2. This codepen project of mine can be fully downloaded for local / offline working from here:
                <a href="https://sourceforge.net/projects/create-website-news-blog-etc/files/Create_Your_Own_Website_News%2C_Magazine%2C_Blogs%2C_Articles_etc..zip/download"
                    target="_blank">Project Website</a> ( Right Click to Copy Link )<br>
                3. My Google Webfonts Help System Open Source Project ( very useful for website designing in all
                languages )
                can also be fully downloaded from here:
                <a href="https://sourceforge.net/projects/google-webfonts-help-system/files/Google_Webfonts_Help_System.zip/download"
                    target="_blank">Project Website</a> ( Right Click to Copy Link )<br>
                4. For many other related Web Based Projects, Please visit my Projects Profile Page :
                <a href="https://sourceforge.net/u/nathan-sr/profile/" target="_blank">My Projects</a> ( Right Click to
                Copy
                Link )
            </p>
        </strong>

        <h1>News, Magazine, Blogs, Articles etc.</h1>
        <div class="time">
            <time><span id='date-time'></span></time>
        </div>

        <link href="https://cdn.jsdelivr.net/gh/linuxguist/news@main/lora.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/gh/linuxguist/news@main/oswald.css" rel="stylesheet">

        <style>
            html, body {
                background: violet;
            }

            h1 {
                font: 700 2.5rem/1 'Oswald', sans-serif;
                text-align: center;
                margin-top: 1px;
                margin-bottom: 14px;
            }

            time {
                font: 700 1.00rem 'Oswald', sans-serif;
                text-align: center;
                text-transform: uppercase;
                border-top: 3px solid #333333;
                border-bottom: 3px solid #333333;
                padding: 6px 0;
                display: block;
            }

            time sup {
                font-size: .675rem;
                font-weight: normal;
            }

            .news-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-content: space-between;
            }

            .article-container {
                text-decoration: none;
                color: black;
                background: burlywood;
                display: flex;
                flex-direction: column;
                width: 28vw;
                min-width: 150px;
                max-width: 700px;
                box-shadow: 2px 2px 25px 2px rgba(0, 0, 0, 0.9);
                margin: 20px;
                transition: 0.3s;
                font-size: 14px;
                font-family: 'Lora', serif;
                font-weight: 400;
            }

            @media only screen and (max-width: 850px) {
                .article-container {
                    width: 90vw;
                }
            }

            .article-container:hover {
                transform: scale(1.02);
                box-shadow: 2px 2px 25px 2px rgba(139, 139, 139, 0.89);
            }

            .article-image {
                width: 100%;
                max-height: 100%;
            }

            .article-title {
                padding: 10px;
            }
        </style>

        <div id='imageGalleryWithTitle' class="news-container">
            @foreach($articles as $article)
            <a href="#" class="article-container" target="_blank">
                <img src="{{ UserHelper::getArticleImage($article->image)}}" alt="Tobacco is a huge health threat. So why aren’t we doing more about it?"
                    class="article-image">
                    <h4>{{ $article->title }}</h4>
                    <h4>{{ $article->category_name }}</h4>
                    <h4>{{ $article->tag_names }}</h4>
                <h3 class="article-title">Tobacco is a huge health threat. So why aren’t we doing more about it?</h3>
            </a>
            @endforeach
        </div>

        <script>
            var dt = new Date();
            document.getElementById('date-time').innerHTML = dt;
        </script>
    </div>
@endsection


