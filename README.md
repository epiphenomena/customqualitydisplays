# customqualitydisplays
Single page business site with portfolio gallery


<https://qcdisplays.com/>


This website has an @index.php that includes @header.php and @footer.php. It is a single page site. We are going to make some elements on the page configurable using data files under /data/ that can be editing using pages and forms under /admin/. There is already an @data/settings.json file and an @admin/settings/index.php for editing some page wide settings like the title element. v

Your first task is to modify ./header.php to use the information in the @data/settings.json file. Do not test for or set default values for the json object in a php file. If the key/value does not already exist in the json file now, then add it. And add it to the @admin/settings/index.php.

Use the public/Parsedown.php file for markdown<->html. Create a data/hero.md file and pull the .hero-content div out of index.php into that markdown file. Change index.php to read the converted markdown into that section. Add an appropriately named subdir to /admin/ with and index.php page that supports editing hero.md