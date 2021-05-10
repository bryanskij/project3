<?php
/* Smarty version 3.1.33, created on 2021-05-10 11:35:13
  from 'D:\OpenServer\domains\project3\template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6098f041bec473_72123477',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '599cdab66874193955ae4ecb6948a8a1bd97f87f' => 
    array (
      0 => 'D:\\OpenServer\\domains\\project3\\template.tpl',
      1 => 1620635711,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:template_".((string)$_smarty_tpl->tpl_vars[\'page\']->value[\'template\']).".tpl' => 1,
  ),
),false)) {
function content_6098f041bec473_72123477 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv=Content-Type content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Проверка статистики</title>
    <link type="text/css" rel="stylesheet" href="/style.css">
</head>
<body>

    <?php $_smarty_tpl->_subTemplateRender("file:template_".((string)$_smarty_tpl->tpl_vars['page']->value['template']).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

    <?php echo '<script'; ?>
 type="text/javascript" src="/jquery-3.4.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="/script.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
