## Table of contents

- [\Plinker\Cron\lib\CronFileWriter](#class-plinkercronlibcronfilewriter)

<hr />

### Class: \Plinker\Cron\lib\CronFileWriter

> Flatfile CRUD class

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$file</strong>)</strong> : <em>void</em><br /><em>construct loads [or creates] the file</em> |
| public | <strong>create(</strong><em>string</em> <strong>$delim=`'#'`</strong>, <em>string</em> <strong>$data=`'
'`</strong>)</strong> : <em>mixed</em><br /><em>Create or update an entry in the .htaccess file</em> |
| public | <strong>delete(</strong><em>string</em> <strong>$delim=`'#'`</strong>)</strong> : <em>bool</em><br /><em>Delete entry from .htaccess file</em> |
| public | <strong>drop()</strong> : <em>void</em> |
| public | <strong>dump()</strong> : <em>void</em> |
| public | <strong>read(</strong><em>string</em> <strong>$delim=`'#'`</strong>)</strong> : <em>mixed (bool/\Plinker\Cron\lib\string)</em><br /><em>Read entry from .htaccess file</em> |
| public | <strong>update(</strong><em>string</em> <strong>$delim=`'#'`</strong>, <em>string</em> <strong>$data=`'
'`</strong>)</strong> : <em>void</em><br /><em>Update entry in .htaccess file</em> |

