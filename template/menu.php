<ul class="main-menu <?=$cssClass?>">
    <?php foreach($menu as $menu):?>       
        <li class="<?=getMenuClass($menu['path'])?>"><a href="<?=$menu['path']?>"><?=cutThisString($menu['title'])?></a></li>
    <?php endforeach; ?>
</ul>