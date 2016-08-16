<%@ Control Language="C#" AutoEventWireup="true" CodeFile="OnlineUser.ascx.cs" Inherits="User_Control_OnlineUser" %>
<asp:Repeater ID="Repeater1" runat="server">
<ItemTemplate>
<%#Eval("name")%>,
</ItemTemplate>
</asp:Repeater>
<asp:Panel ID="Panel1" CssClass="user_online" runat="server"></asp:Panel>
