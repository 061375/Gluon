[[#standard
<div>
    <div class="left">[#standard.left#]</div>
    <div class="right"><input type="text" name="[#form.name#]" value="[#form.value#]" /></div>
</div>
#]]
[[#select
<div>
    <select name="[#form.name#]">
        [<#
        <option value="[#form.value#]">[#form.text#]</option>
        #>]
    </select>
</div>
#]]