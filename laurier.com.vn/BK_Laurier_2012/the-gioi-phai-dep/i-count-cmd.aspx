<%
	Dim dsCmdCount as DataSet
	dsCmdCount = get_CmdCount(CInt(bean.TinTuc_Id))
	If dsCmdCount.Tables(0).Rows.Count()>0 Then
	For Each drCmdCout As DataRow In dsCmdCount.Tables(0).Rows	
	Response.Write(" <em>( " & drCmdCout.Item(0) &" B&#236;nh lu&#7853;n )</em> " )
	Next
	End If
%>