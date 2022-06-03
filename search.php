<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Пример веб-страницы</title>

</head>
<body class="text-center">
<main class="form-signin" style="width: 300px;margin-left: auto; margin-right: auto;">

        <div class="form-floating">
            <input type="search" class="form-control" id="searchInput" name="searchInput" placeholder="What article you wants">
            <label for="searchInput">What article you wants</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" id="clickSearch">Search</button>

</main>
<main id="article">

</main>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function (){
        $("#clickSearch").on('click', function (){
            var word = $("#searchInput").val();
            $.ajax({
                type: "POST",
                url: 'api.php',
                data: {q: word},
                success: function(data){
                    showArticle(data);
                }
            });
        })

        function showArticle(data){
           var article = JSON.parse(data);
           let innerHTML = "";
           var postArticle = document.getElementById('article') ;

           for (let i = 0; i < article.length; i++ ){
               innerHTML += `<div class="px-4 pt-5 my-5 text-center border-bottom">
                             <h1 class="display-4 fw-bold"> ${article[i].headline}</h1>
                                <div class="col-lg-6 mx-auto">
                                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                                        <a href="${article[i].web_url}" class="btn btn-primary btn-lg px-4 me-sm-3">Перейти</a>
                                    </div>
                                </div>
                              </div>`
           }
           postArticle.innerHTML += innerHTML;
        }
        $(window).on('scroll', function() {
            let myDiv = $("#article") ;
            let i = 0;
            var isEvent = false;

            if ($(window).scrollTop() >= myDiv.offset().top + myDiv.outerHeight() - window.innerHeight) {
                i++;
                isEvent = true;
                var word = $("#searchInput").val();

                setTimeout( function() {
                    isEvent = false;
                }, 1000 );
            }
            if (isEvent){
                $.ajax({
                    type: "POST",
                    url: 'api.php',
                    data: {q: word, page: i},
                    success: function(data){
                        showArticle(data);
                    }
                });
            }
        });




    });

</script>
</body>
</html>

