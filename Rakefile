desc "Rsync website to Dreamhost"
task :sync do
    sh "rsync -avzzh --progress --delete --exclude .git --exclude Rakefile ./ timlawles@dream:qcdisplays.com/"
end

desc "Run development server"
task :serve do
    sh "php -S localhost:8000 -t ./public/"
end