desc "Rsync website to Dreamhost"
task :sync do
    sh "rsync -avzzh --progress --delete --exclude .git --exclude Rakefile --exclude data/ --exclude media/ ./public/ timlawles@dream:qcdisplays.com/"
    sh "rsync -avzzh --progress --delete timlawles@dream:qcdisplays.com/data/ ./public/data/"
    sh "rsync -avzzh --progress --delete timlawles@dream:qcdisplays.com/media/ ./public/media/"
end

desc "Run development server"
task :serve do
    sh "php -S localhost:8000 -t ./public/"
end