<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="{{ asset("js/main.js" )}}" type="module"></script>
    <link rel="stylesheet" href="{{asset("stylesheets/import.css")}}">
    <title>Wiki app</title>
</head>
<body>
    <main>
        <div class="app">
            <div class="container">
                <div class="app__wrapper">
                    <div class="app__control_panel">
                        <button class="btn import_articles__btn">Импорт статей</button>
                        <button class="btn search_articles__btn">Поиск</button>
                    </div>
                    <div class="app__inner">
                        <div class="container">
                            <div class="import_articles__wrapper">
                                <form class="wiki_import">
                                    <input type="text" class="wiki_import__field" value="Никита" placeholder="Ключевое слово">
                                    <button type="submit" class="wiki_import__btn">Скопировать</button>
                                </form>
                                <div class="import_info">
                                    <p class="import__success hidden">Импорт завершён!</p>
                                </div>
                                <div class="articles">
                                    @if(count($articles) > 0)
                                        <table class="articles__table">
                                            <thead>
                                            <tr>
                                                <td>Название статей</td>
                                                <td>Ссылка</td>
                                                <td>Размер статьи</td>
                                                <td>Количество слов</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($articles as $article)
                                                <tr>
                                                    <td>{{$article->title}}</td>
                                                    <td>{{$article->url}}</td>
                                                    <td>{{$article->size}}kb</td>
                                                    <td>{{$article->count_words}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>На данный момент статей в хранилище нет</p>
                                    @endif
                                </div>
                            </div>
                            <div class="search_articles__wrapper hidden">
                                <form class="articles_search">
                                    <input type="text" class="search_field" value="Никита" placeholder="Поисковая фраза">
                                    <button type="submit" class="search_btn">Скопировать</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
