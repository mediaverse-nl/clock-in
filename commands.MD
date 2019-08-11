Enter the docker container:  
```docker exec -u www-data -it clockon_php_1 /bin/sh```

Set the right ownership of the storage folder ( recursive ):
```docker exec -u root clockon_php_1 chown -R www-data:www-data storage/
docker exec -u root clockon_php_1 chown -R www-data:www-data bootstrap/cache
sudo usermod -a -G docker www-data  
sudo chgrp -R docker src/
```