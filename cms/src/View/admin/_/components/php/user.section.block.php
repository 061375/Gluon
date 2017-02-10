[[#standard
<section>
    <div class="left">[#standard.left#]</div>
    <div class="right"><input type="text" name="[#form.name#]" value="[#form.value#]" /></div>
</section>
#]]
[[#select
<section>
    <select name="[#form.name#]">
        [<#
        <option value="[#form.value#]">[#form.text#]</option>
        #>]
    </select>
</section>
#]]