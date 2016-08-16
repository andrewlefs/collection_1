<%
	Dim dsCmdCount as DataSet
	dsCmdCount = get_CmdCount(id)
	If dsCmdCount.Tables(0).Rows.Count()>0 Then
	For Each drCmdCout As DataRow In dsCmdCount.Tables(0).Rows	
	Response.Write(" <em>(C&#243;&nbsp;" & drCmdCout.Item(0) &" b&#236;nh lu&#7853;n )</em> " )
	Next
	End If
%>