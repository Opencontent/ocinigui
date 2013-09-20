<form method="post" action={'inigui/generalink'|ezurl()}>
    <input type="text" name="url" value={$url} />
    <input class="button" type="submit" value="Genera" />
</form>

<ul>
    {foreach $links as $sa => $link}
    <li><a href="http://{$link}">{$link}</a></li>
    {/foreach}
</ul>