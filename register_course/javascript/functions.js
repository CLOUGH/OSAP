function toggleTable(table_id)
{
	var table =document.getElementById(table_id);
	if(table.style.display=='none')

		table.style.display = 'block';
	else
		table.style.display = 'none';
	return false;
}