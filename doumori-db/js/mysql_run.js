function query_run(database,query_log,sql_val){
	$.ajax({
		url:'../php/sql.php',
		type:'POST',
		data:{
			'database':database,
			'sql':sql_val,
			'query_log':query_log,
		}
	})
	// Ajaxリクエストが成功した時の処理
	.done((data) => {
		$('#sql_result').html(data);
		console.log('done');
	})
	// Ajaxリクエストが失敗した時の処理
	.fail((data) => {
		console.log('failed');
	})
	// 常時の処理
	.always((data) => {
	});
}
