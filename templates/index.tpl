{extends file='layouts/layout.tpl'}

{block name=body}
	<h2>Todo App</h2>
	<form action="../index.php" method="post">
		<label>
			<input type="text" name="task" autocomplete="off" autofocus placeholder="タスクを入力してください">
		</label>
		<button type="submit">追加</button>
	</form>
	<h3>タスクリスト</h3>
	<ul>
        {foreach $tasks as $index => $task}
			<li>
                {$task}
				<form action="../index.php" method="post" style="display: inline;">
					<input type="hidden" name="delete" value="{$index}">
					<button type="submit">削除</button>
				</form>
			</li>
        {/foreach}
	</ul>
{/block}