<{if $error_message|default:'' == ''}>
    <div align="left">
        <form id="form_permission" name="form_dpermission" method="get" action="permission.php">
            <select name="permission" id="permission" onchange="location='permission.php?permission='+this.options[this.selectedIndex].value">
                <{$permission_options}>
            <select>
        </form>
    </div>
    <{$form}>
<{else}>
    <div class="errorMsg" style="text-align: left;">
        <{$error_message}>
    </div>
<{/if}>