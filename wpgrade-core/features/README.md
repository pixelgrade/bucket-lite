This folder contains feature tests. These tests ensure user use cases work; for
tests on on the code itself refer to wpgrade-system/tests.

Only behavior tests in available are executed. Please move tests between
available and unavailable. The presence of files in unavailable is considered
a design choice.

All behavior tests are based on the default wordpress unit tests:
https://wpcom-themes.svn.automattic.com/demo/theme-unit-test-data.xml

Note: these tests were not designed to emulate the process, any overlap is
coincidental; the tests are merely designed to test behavior such as
availability of pages, javascript functionality behaving as expected, required
text/help/messages being present etc.


In layman terms...

 * wpgrade-system/tests ensures the tools we use are good
 * wpgrade-features ensures the way we use the tools is sane
