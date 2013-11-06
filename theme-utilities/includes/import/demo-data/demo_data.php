<?php

//The export from the Theme Options - base64 encoded: http://www.base64encode.org/
// Encode in base64 with http://www.opinionatedgeek.com/dotnet/tools/base64encode because base64encode.org lacks in memory and it cannot decode long strings
$theme_options = "eyJsYXN0X3RhYiI6IjciLCJtYWluX2xvZ28iOnsidXJsIjoiaHR0cDpcL1wvcGl4ZWxncmFkZS5jb21cL2RlbW9zXC9idWNrZXRcL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMTNcLzEwXC9sb2dvLWJ1Y2tldC0xeC5wbmciLCJpZCI6IjE5NyIsImhlaWdodCI6IjQxIiwid2lkdGgiOiIyMTUiLCJ0aHVtYm5haWwiOiIifSwidXNlX3JldGluYV9sb2dvIjoiMSIsInJldGluYV9tYWluX2xvZ28iOnsidXJsIjoiaHR0cDpcL1wvcGl4ZWxncmFkZS5jb21cL2RlbW9zXC9idWNrZXRcL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMTNcLzEwXC9sb2dvLWJ1Y2tldC0yeC5wbmciLCJpZCI6IjE5OCIsImhlaWdodCI6IjgyIiwid2lkdGgiOiI0MzAiLCJ0aHVtYm5haWwiOiIifSwiZmF2aWNvbiI6eyJ1cmwiOiJodHRwOlwvXC9waXhlbGdyYWRlLmNvbVwvZGVtb3NcL2J1Y2tldFwvd3AtY29udGVudFwvdXBsb2Fkc1wvMjAxM1wvMTBcL2Zhdmljb24tYnVja2V0LnBuZyIsImlkIjoiMTk2IiwiaGVpZ2h0IjoiMTYiLCJ3aWR0aCI6IjE2IiwidGh1bWJuYWlsIjoiIn0sImFwcGxlX3RvdWNoX2ljb24iOnsidXJsIjoiIiwiaWQiOiIiLCJoZWlnaHQiOiIiLCJ3aWR0aCI6IiIsInRodW1ibmFpbCI6IiJ9LCJtZXRyb19pY29uIjp7InVybCI6IiIsImlkIjoiIiwiaGVpZ2h0IjoiIiwid2lkdGgiOiIiLCJ0aHVtYm5haWwiOiIifSwibWFpbl9jb2xvciI6IiNkZDMzMzMiLCJ1c2VfZ29vZ2xlX2ZvbnRzIjoiMCIsImdvb2dsZV90aXRsZXNfZm9udCI6eyJmb250LWZhbWlseSI6IiIsImdvb2dsZSI6ImZhbHNlIiwiZm9udC13ZWlnaHQiOiIiLCJmb250LXN0eWxlIjoiIiwic3Vic2V0cyI6IiJ9LCJnb29nbGVfbmF2X2ZvbnQiOnsiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUiOiJmYWxzZSIsImZvbnQtd2VpZ2h0IjoiIiwiZm9udC1zdHlsZSI6IiIsInN1YnNldHMiOiIiLCJjb2xvciI6IiJ9LCJnb29nbGVfYm9keV9mb250Ijp7ImZvbnQtZmFtaWx5IjoiIiwiZ29vZ2xlIjoiZmFsc2UiLCJmb250LXdlaWdodCI6IiIsImZvbnQtc3R5bGUiOiIiLCJzdWJzZXRzIjoiIiwiZm9udC1zaXplIjoicHgiLCJsaW5lLWhlaWdodCI6InB4In0sImJsb2dfc2luZ2xlX3Nob3dfc2hhcmVfbGlua3MiOiIxIiwiYmxvZ19leGNlcnB0X2xlbmd0aCI6IjIwIiwiYmxvZ19leGNlcnB0X21vcmVfdGV4dCI6Ii4uIiwiaGVhZGVyX3R5cGUiOiJ0eXBlMSIsImhlYWRlcl83MjhfOTBfYWQiOiIgICAgICAgICAgICAgICAgPGEgY2xhc3M9XCJoZWFkZXItYWQtbGlua1wiIGhyZWY9XCIjXCI+XHJcbiAgICA8aW1nIHNyYz1cImh0dHA6XC9cL3BpeGVsZ3JhZGUuY29tXC9kZW1vc1wvYnVja2V0XC93cC1jb250ZW50XC91cGxvYWRzXC8yMDEzXC8xMFwvYWQtNzI4eDkwLmpwZ1wiIGFsdD1cIiNcIiBcLz5cclxuPFwvYT4gICAgICAgICAgICAiLCJuYXZfaW52ZXJzZV90b3AiOiIwIiwibmF2X2ludmVyc2VfbWFpbiI6IjAiLCJuYXZfc2hvd19oZWFkZXJfc29jaWFsX2ljb25zIjoiMSIsIm5hdl9zaG93X2hlYWRlcl9zZWFyY2giOiIxIiwiY29weXJpZ2h0X3RleHQiOiJDb3B5cmlnaHQgXHUwMGE5IDIwMTMgQnVja2V0IHwgQWxsIHJpZ2h0cyByZXNlcnZlZC4iLCJzb2NpYWxfaWNvbnMiOnsidHdpdHRlciI6eyJ2YWx1ZSI6Imh0dHBzOlwvXC90d2l0dGVyLmNvbVwvcGl4ZWxncmFkZSIsImNoZWNrYm94ZXMiOnsid2lkZ2V0Ijoib24iLCJoZWFkZXIiOiJvbiJ9fSwiZmFjZWJvb2siOnsidmFsdWUiOiJodHRwczpcL1wvd3d3LmZhY2Vib29rLmNvbVwvUGl4ZWxHcmFkZU1lZGlhIiwiY2hlY2tib3hlcyI6eyJ3aWRnZXQiOiJvbiIsImhlYWRlciI6Im9uIn19LCJyc3MiOnsidmFsdWUiOiJodHRwOlwvXC9waXhlbGdyYWRlLmNvbVwvZGVtb3NcL2J1Y2tldFwvcnNzIiwiY2hlY2tib3hlcyI6eyJ3aWRnZXQiOiJvbiIsImhlYWRlciI6Im9uIn19LCJncGx1cyI6eyJ2YWx1ZSI6Imh0dHBzOlwvXC9wbHVzLmdvb2dsZS5jb21cLzExNzAxODAyMTgxMDM2NzU0NDI0OFwvYWJvdXQiLCJjaGVja2JveGVzIjp7IndpZGdldCI6Im9uIn19LCJ2aW1lbyI6eyJ2YWx1ZSI6InZpbWVvLmNvbSIsImNoZWNrYm94ZXMiOnsid2lkZ2V0Ijoib24ifX0sImZsaWNrciI6eyJ2YWx1ZSI6IiJ9LCJ0dW1ibHIiOnsidmFsdWUiOiIifSwicGludGVyZXN0Ijp7InZhbHVlIjoiIn0sImluc3RhZ3JhbSI6eyJ2YWx1ZSI6Imh0dHA6XC9cL2luc3RhZ3JhbS5jb21cL2JhYmJhcmRlbCIsImNoZWNrYm94ZXMiOnsid2lkZ2V0Ijoib24ifX0sImJlaGFuY2UiOnsidmFsdWUiOiIifSwiZml2ZWh1bmRyZWRweCI6eyJ2YWx1ZSI6IiJ9LCJkZXZpYW50YXJ0Ijp7InZhbHVlIjoiIn0sImRyaWJiYmxlIjp7InZhbHVlIjoiIn0sInlvdXR1YmUiOnsidmFsdWUiOiIifSwibGlua2VkaW4iOnsidmFsdWUiOiIifSwic2t5cGUiOnsidmFsdWUiOiIifSwic291bmRjbG91ZCI6eyJ2YWx1ZSI6IiJ9LCJkaWdnIjp7InZhbHVlIjoiIn0sImxhc3RmbSI6eyJ2YWx1ZSI6IiJ9LCJhcHBuZXQiOnsidmFsdWUiOiIifX0sInNvY2lhbF9pY29uc190YXJnZXRfYmxhbmsiOiIxIiwicHJlcGFyZV9mb3Jfc29jaWFsX3NoYXJlIjoiMSIsImZhY2Vib29rX2lkX2FwcCI6IiIsImZhY2Vib29rX2FkbWluX2lkIjoiIiwiZ29vZ2xlX3BhZ2VfdXJsIjoiIiwidHdpdHRlcl9jYXJkX3NpdGUiOiIiLCJzb2NpYWxfc2hhcmVfZGVmYXVsdF9pbWFnZSI6eyJ1cmwiOiIiLCJpZCI6IiIsImhlaWdodCI6IiIsIndpZHRoIjoiIiwidGh1bWJuYWlsIjoiIn0sInVzZV90d2l0dGVyX3dpZGdldCI6IjEiLCJ0d2l0dGVyX2NvbnN1bWVyX2tleSI6IlVHY2lVa1B3akRwQ1J5RXFjR3NiZyIsInR3aXR0ZXJfY29uc3VtZXJfc2VjcmV0IjoibnVIa3FSTHhLVEVJc1RIdU9qcjFYWDVZWllldEVSNkhGN3BLeGtWMTFFIiwidHdpdHRlcl9vYXV0aF9hY2Nlc3NfdG9rZW4iOiIyMDU4MTMwMTEtb0x5Z2hSd3FSTkhiWlNoT2ltbEdLZkE2Qkk0aGszS1JCV3FsRFlJWCIsInR3aXR0ZXJfb2F1dGhfYWNjZXNzX3Rva2VuX3NlY3JldCI6IjRMcWxaamY3akRxbXhxWFFqYzZNeUl1dEhDWFBTdElhM1R2RUhYOU5FWXciLCJjdXN0b21fY3NzIjoiI3RleHQtMyAud2lkZ2V0X190aXRsZSB7IGRpc3BsYXk6IG5vbmU7IH1cclxuLmhlYWRlci0tdHlwZTIgLm5hdi0tdG9wLXJpZ2h0IHsgZGlzcGxheTogbm9uZTsgfVxyXG4uaGVhZGVyLS10eXBlMyAubmF2LS10b3AtcmlnaHQgeyBkaXNwbGF5OiBub25lOyB9IiwiaW5qZWN0X2N1c3RvbV9jc3MiOiJpbmxpbmUiLCJjdXN0b21fanMiOiIgICAgICAgICAgICAgICAgICAgICAgICAgICAgIiwiY3VzdG9tX2pzX2Zvb3RlciI6IiAgICAgICAgICAgICAgICAgICAgICAgICAgICAiLCJ0aGVtZWZvcmVzdF91cGdyYWRlIjoiMSIsIm1hcmtldHBsYWNlX3VzZXJuYW1lIjoiIiwibWFya2V0cGxhY2VfYXBpX2tleSI6IiIsInRoZW1lZm9yZXN0X3VwZ3JhZGVfYmFja3VwIjoiMCIsIlJFRFVYX2ltcG9ydGVkIjpmYWxzZSwiYmxvZ19zaW5nbGVfc2hhcmVfbGlua3NfdHdpdHRlciI6MCwiYmxvZ19zaW5nbGVfc2hhcmVfbGlua3NfZmFjZWJvb2siOjAsImJsb2dfc2luZ2xlX3NoYXJlX2xpbmtzX2dvb2dsZXBsdXMiOjAsInR5cG9ncmFwaHktMjEiOiIiLCJhcnRpY2xlLTIxIjoiIiwiaW5mb19hYm91dF90d2l0dGVyX2FwcCI6IiIsIndwR3JhZGVfaW1wb3J0X2RlbW9kYXRhX2J1dHRvbiI6IiIsIlJFRFVYX2xhc3Rfc2F2ZWQiOjEzODM3MjYxMTQsInJlZHV4LWJhY2t1cCI6IjEifQ==";

//The export of the widgets using this plugin http://wordpress.org/plugins/widget-settings-importexport/ - base64 encoded: http://www.base64encode.org/
$demo_widgets = "W3sid3BfaW5hY3RpdmVfd2lkZ2V0cyI6WyJhcmNoaXZlcy0yIiwiY2F0ZWdvcmllcy0yIiwic2VhcmNoLTIiLCJwcHR3ai0yIiwibWV0YS0yIiwicmVjZW50LWNvbW1lbnRzLTMiLCJyZWNlbnQtY29tbWVudHMtMiIsInJlY2VudC1wb3N0cy0yIiwiaW1hZ2UtMyIsImltYWdlLTIiXSwic2lkZWJhciI6WyJ3cGdyYWRlX2xhdGVzdF9yZXZpZXdzLTIiLCJ3cGdyYWRlX3Bvc3RzX3NsaWRlcl93aWRnZXQtMiIsInJlY2VudC1jb21tZW50cy00Il0sInNpZGViYXItZm9vdGVyLWZpcnN0LTEiOlsidGV4dC0yIl0sInNpZGViYXItZm9vdGVyLWZpcnN0LTIiOlsibmF2X21lbnUtMiIsInRleHQtMyJdLCJzaWRlYmFyLWZvb3Rlci1maXJzdC0zIjpbInRhZ19jbG91ZC0yIl0sInNpZGViYXItZm9vdGVyLXNlY29uZC0xIjpbIndwZ3JhZGVfdHdpdHRlcl93aWRnZXQtMiJdLCJzaWRlYmFyLWZvb3Rlci1zZWNvbmQtMiI6WyJ3cGdyYWRlX3NvY2lhbF9saW5rcy0yIl19LHsiIjp7ImN0aW9uIjpudWxsLCJfbXVsdGl3aWRnZXQiOm51bGwsIndwbm9uY2UiOm51bGwsIndwX2h0dHBfcmVmZXJlciI6bnVsbH0sIndwZ3JhZGVfbGF0ZXN0X3Jldmlld3MiOnsiMiI6eyJ0aXRsZSI6IkxhdGVzdCBSZXZpZXdzIiwibnVtYmVyIjo1fSwiX211bHRpd2lkZ2V0IjoxfSwid3BncmFkZV9wb3N0c19zbGlkZXJfd2lkZ2V0Ijp7IjIiOnsidGl0bGUiOiJMYXRlc3QgUG9zdHMiLCJudW1iZXIiOjN9LCJfbXVsdGl3aWRnZXQiOjF9LCJyZWNlbnQtY29tbWVudHMiOnsiNCI6eyJ0aXRsZSI6IkxhdGVzdCBDb21tZW50cyIsIm51bWJlciI6M30sIjMiOnsidGl0bGUiOiJMYXRlc3QgQ29tbWVudHMiLCJudW1iZXIiOjV9LCIyIjp7InRpdGxlIjoiIiwibnVtYmVyIjo1fSwiX211bHRpd2lkZ2V0IjoxfSwidGV4dCI6eyIyIjp7InRpdGxlIjoiQWJvdXQgQnVja2V0IiwidGV4dCI6IjxpbWcgY2xhc3M9XCJhbGlnbmxlZnRcIiBzcmM9XCJodHRwOlwvXC9waXhlbGdyYWRlLmNvbVwvZGVtb3NcL2J1Y2tldFwvd3AtY29udGVudFwvdXBsb2Fkc1wvMjAxM1wvMTBcL2J1Y2tldC1mb290ZXItbG9nby5wbmdcIj4gV2UgYXJlIGEgeW91bmcgYW5kIHBhc3Npb25hdGUgd2ViIGRlc2lnbiBhbmQgZGV2ZWxvcG1lbnQgdGVhbSBmcm9tIElhc2ksIFJvbWFuaWEuIFdlIHRha2UgcHJpZGUgaW4gb3VyIHdvcmsuXHJcblxyXG5FdmVyeSBmZWF0dXJlIHdhcyBjYXJlZnVsbHkgY2hvc2VuIGFuZCBkZXNpZ25lZCB0byBlYXNlIHRoZSB3YXkgdG8gdGhhdCBwZXJmZWN0IG5ld3Mgb3IgbWFnYXppbmUgd2Vic2l0ZS5cclxuXHJcbjxhIGNsYXNzPVwiYnRuXCIgaHJlZj1cIiNcIj5GdXJ0aGVyIE1vcmU8XC9hPiIsImZpbHRlciI6dHJ1ZX0sIjMiOnsidGl0bGUiOiJFbWFpbCBOZXdzbGV0dGVyIiwidGV4dCI6IjxkaXYgaWQ9XCJtY19lbWJlZF9zaWdudXBcIj5cclxuPGZvcm0gYWN0aW9uPVwiaHR0cDpcL1wvZmFjZWJvb2sudXM3Lmxpc3QtbWFuYWdlLmNvbVwvc3Vic2NyaWJlXC9wb3N0P3U9Mjc4NDAxOGIxZDM3YzNhOWZkMzM0ZmJlYiZhbXA7aWQ9ZTI0ZGI2MDQyOFwiIG1ldGhvZD1cInBvc3RcIiBpZD1cIm1jLWVtYmVkZGVkLXN1YnNjcmliZS1mb3JtXCIgbmFtZT1cIm1jLWVtYmVkZGVkLXN1YnNjcmliZS1mb3JtXCIgY2xhc3M9XCJ2YWxpZGF0ZSBmb3JtLWlubGluZVwiIHRhcmdldD1cIl9ibGFua1wiIG5vdmFsaWRhdGU+XHJcblxyXG5cdDxkaXYgY2xhc3M9XCJmb3JtLWdyb3VwXCI+XHJcblx0XHQ8ZGl2IGNsYXNzPVwiaW5wdXQtZ3JvdXBcIj5cclxuXHQgICAgXHQ8aW5wdXQgdHlwZT1cImVtYWlsXCIgdmFsdWU9XCJcIiBuYW1lPVwiRU1BSUxcIiBjbGFzcz1cInJlcXVpcmVkIGVtYWlsIGZvcm0tY29udHJvbFwiIGlkPVwibWNlLUVNQUlMXCIgcGxhY2Vob2xkZXI9XCJFbnRlciB5b3VyIGVtYWlsIGFkZHJlc3MuLlwiPlxyXG5cdCAgICBcdDxzcGFuIGNsYXNzPVwiaW5wdXQtZ3JvdXAtYnRuXCI+XHJcblxyXG5cdFx0ICAgICAgICA8YnV0dG9uIHR5cGU9XCJzdWJtaXRcIiBuYW1lPVwic3Vic2NyaWJlXCIgaWQ9XCJtYy1lbWJlZGRlZC1zdWJzY3JpYmVcIiBjbGFzcz1cImJ0biBidG4tZGVmYXVsdCBidG4tLWxhcmdlXCI+XHJcblx0XHQgICAgICAgIFx0PGkgY2xhc3M9XCJwaXhjb2RlICBwaXhjb2RlLS1pY29uICBpY29uLWUtbWFpbCBtZWRpdW1cIj48XC9pPlxyXG5cdFx0ICAgICAgICA8XC9idXR0b24+XHJcblx0XHQgICAgPFwvc3Bhbj5cclxuXHQgICAgPFwvZGl2PlxyXG4gIFx0PFwvZGl2PlxyXG4gIFxyXG5cclxuXHQ8ZGl2IGlkPVwibWNlLXJlc3BvbnNlc1wiIGNsYXNzPVwiY2xlYXJcIj5cclxuXHRcdDxkaXYgY2xhc3M9XCJyZXNwb25zZVwiIGlkPVwibWNlLWVycm9yLXJlc3BvbnNlXCIgc3R5bGU9XCJkaXNwbGF5Om5vbmVcIj48XC9kaXY+XHJcblx0XHQ8ZGl2IGNsYXNzPVwicmVzcG9uc2VcIiBpZD1cIm1jZS1zdWNjZXNzLXJlc3BvbnNlXCIgc3R5bGU9XCJkaXNwbGF5Om5vbmVcIj48XC9kaXY+XHJcblx0PFwvZGl2Plx0XHJcbjxcL2Zvcm0+XHJcbjxcL2Rpdj4iLCJmaWx0ZXIiOmZhbHNlfSwiX211bHRpd2lkZ2V0IjoxfSwibmF2X21lbnUiOnsiMiI6eyJ0aXRsZSI6IkN1c3RvbSBNZW51IiwibmF2X21lbnUiOjU0fSwiX211bHRpd2lkZ2V0IjoxfSwidGFnX2Nsb3VkIjp7IjIiOnsidGl0bGUiOiJUYWdzIENsb3VkIiwidGF4b25vbXkiOiJwb3N0X3RhZyJ9LCJfbXVsdGl3aWRnZXQiOjF9LCJ3cGdyYWRlX3R3aXR0ZXJfd2lkZ2V0Ijp7IjIiOnsidGl0bGUiOiJUd2VldHMiLCJ1c2VybmFtZSI6InBpeGVsZ3JhZGUiLCJjb3VudCI6NSwibnJfcGVyX3NsaWRlIjoyfSwiX211bHRpd2lkZ2V0IjoxfSwid3BncmFkZV9zb2NpYWxfbGlua3MiOnsiMiI6eyJ0aXRsZSI6IldlIEFyZSBTb2NpYWwifSwiX211bHRpd2lkZ2V0IjoxfSwiYXJjaGl2ZXMiOnsiMiI6eyJ0aXRsZSI6IiIsImNvdW50IjowLCJkcm9wZG93biI6MH0sIl9tdWx0aXdpZGdldCI6MX0sImNhdGVnb3JpZXMiOnsiMiI6eyJ0aXRsZSI6IiIsImNvdW50IjowLCJoaWVyYXJjaGljYWwiOjAsImRyb3Bkb3duIjowfSwiX211bHRpd2lkZ2V0IjoxfSwic2VhcmNoIjp7IjIiOnsidGl0bGUiOiIifSwiX211bHRpd2lkZ2V0IjoxfSwicHB0d2oiOnsiMiI6eyJ0aXRsZSI6IlBvcHVsYXIgUG9zdHMiLCJudW1iZXIiOjUsInRodW1iX3NpemUiOjQ1LCJzaG93X2RhdGUiOiIiLCJzaG93X3ZpZXdzIjoib24iLCJvcmRlciI6InBvcCIsInBvcCI6IiIsImxhdGVzdCI6Im9uIiwiY29tbWVudHMiOiJvbiIsInBvcHVsYXJfcmFuZ2UiOiJhbGwiLCJjb21tZW50c19yYW5nZSI6ImRhaWx5In0sIl9tdWx0aXdpZGdldCI6MX0sIm1ldGEiOnsiMiI6eyJ0aXRsZSI6IiJ9LCJfbXVsdGl3aWRnZXQiOjF9LCJyZWNlbnQtcG9zdHMiOnsiMiI6eyJ0aXRsZSI6IiIsIm51bWJlciI6NX0sIl9tdWx0aXdpZGdldCI6MX0sImltYWdlIjp7IjMiOnsidGl0bGUiOiIiLCJpbWdfdXJsIjoiaHR0cDpcL1wvcGl4ZWxncmFkZS5jb21cL2RlbW9zXC9idWNrZXRcL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMTNcLzEwXC9hZC0zMDB4MjUwLTIuanBnIiwiYWx0X3RleHQiOiIiLCJpbWdfdGl0bGUiOiIiLCJjYXB0aW9uIjoiIiwiYWxpZ24iOiJub25lIiwiaW1nX3dpZHRoIjowLCJpbWdfaGVpZ2h0IjowLCJsaW5rIjoiaHR0cDpcL1wvdGhlbWVmb3Jlc3QubmV0XC9pdGVtXC9sZW5zLWFuLWVuam95YWJsZS1waG90b2dyYXBoeS13b3JkcHJlc3MtdGhlbWVcLzU3MTM0NTIifSwiMiI6eyJ0aXRsZSI6IiIsImltZ191cmwiOiJodHRwOlwvXC9waXhlbGdyYWRlLmNvbVwvZGVtb3NcL2J1Y2tldFwvd3AtY29udGVudFwvdXBsb2Fkc1wvMjAxM1wvMTBcL2FkLTMwMHgyNTAuanBnIiwiYWx0X3RleHQiOiIiLCJpbWdfdGl0bGUiOiIiLCJjYXB0aW9uIjoiIiwiYWxpZ24iOiJub25lIiwiaW1nX3dpZHRoIjozMTMsImltZ19oZWlnaHQiOjI1MCwibGluayI6Imh0dHA6XC9cL3RoZW1lZm9yZXN0Lm5ldFwvaXRlbVwvbGVucy1hbi1lbmpveWFibGUtcGhvdG9ncmFwaHktd29yZHByZXNzLXRoZW1lXC81NzEzNDUyIn0sIl9tdWx0aXdpZGdldCI6MX19XQ==";
