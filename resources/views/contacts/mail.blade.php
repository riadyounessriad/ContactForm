<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ContactForm</title>
</head>
<body>
<img width="100%" src="https://www.litmus.com/wp-content/uploads/2020/04/email-client-market-share-2019-blog.png" alt="">
<div style="border:0.5px solid #0088cc">
    <div style="background:#0088cc;color:#000;font-size:28px;font-weight:bold;padding:2rem;text-align: center;">
        {{ $sujet }}
    </div>
    <div style="background:#fff;color:#000;padding:0.2rem;padding-left:0.3rem;padding-bottom:0.5rem;font-size:16px;margin-top:2rem;">
        <div style="padding-bottom:2rem;">
             {{ $description }}
        </div>
        
        <hr>
        Envoi par :<a href = "mailto: {{ $email }}">{{ $email }}</a>
    </div>
    
</div>


</body>
</html>

