

<title>GET VIDEO YOUTUBE</title>
<body>
     <center>
         <p><b>-------------------------------------[GET VIDEO YOUTUBE]-------------------------------------</b></p>
    <form method="post" action="{{url('admin/getlink')}}">
        @csrf
        <input type="url" value="<?php if (isset($Fulllink)) echo $Fulllink;?>" name="youtube_link">
        <input type="submit" value="GET" name="sub">
    </form>

<footer>
    <p><b>------------------------------[ Code by Sokoda Haraki ( Nguyễn Hưng ) ]------------------------------</b></p>
</footer>
<style type="text/css" media="screen">
a{
    -webkit-transition: 0.3s;
}
a:link, a:visited {
    border: 2px solid white;
    color: white;
    padding: 14px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;

}

body{
    background-color: Black;
    margin-top:10%;
}
a:hover {
    transition: 0.3s;
    background-color: white;
    color:black;
}
a:active{
    background-color: #eeeeee;
    color:black;
}
input[type = url]{
    width: 540px;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid white;
    background-color: Black;
    color: white;
}
input[type = submit]{
    width: 80px;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid white;
    background-color: Black;
    color: white;
}
input[type = submit]:hover{
    transition: 0.3s;
    background-color: white;
    color:black;
}
iframe{
    border: 2px solid white;
}
p{
    color:white;
}
</style>
</center>
</body>
