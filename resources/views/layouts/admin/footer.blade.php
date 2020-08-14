<footer class="footer d-none d-sm-block">
    <div class="container-fluid">
        <nav class="pull-left">
            <ul class="nav">
                <li class="nav-item">
                    {{date('Y')}} © <a href="https://ngekost.id" target="_blank" class=""> NgekostID &nbsp;</a><br>
                </li>
            </ul>
        </nav>
        |&nbsp;<small>Rendered {{ round((microtime(true) - LARAVEL_START),3) }}s</small>
        <div class="copyright ml-auto">
            <a href="https://www.themekita.com">Hand-crafted & Made with <i class="la la-heart heart text-danger"></i> </a>
        </div>				
    </div>
</footer>