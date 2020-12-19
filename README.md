## Add to .env file  
```
HUE_BRIDGE_IP="192.168.1.10"  
HUE_DEVICETYPE="Device or application name"  
```

## Step 2: Run connect command  
```
php artisan hue:connect
```

## Step 3: Press button on Hue bridge  

## Step 4: Run connect command again  
```
php artisan hue:connect
```

## Step 5: Import lights & groups
```
php artisan hue:import-lights
php artisan hue:import-groups
```

## API test tool  
http://${HUE_BRIDGE_IP}/debug/clip.html  

