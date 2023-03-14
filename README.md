# Hasher 

Hasher is a php package for generating dynamic or static hashes by combining varying hashing algorithms in a specific number of times.

#### Initializing Class 

The hasher class can be instantiated as shown below 

```php
include_once 'vendor/autoload.php'

use Spoova/Hasher/Hasher;

$Hasher = new Hasher;
```

#### Definining Hash Data

The data to be hashed can be defined by using the ```setHash()``` method using the syntax below

```php 
$Hasher->setHash($data, $key);
```

  + ```$data``` : data to be hashed 
  + ```$key``` : an optional secret key.  

An example of data specified to be hashed is shown below 

```php 
$Hasher->setHash(['name' => 'foo'], 'some_secret_key');
```

#### Defining Hashing Algorithm 

The ```hashFunc``` method is being used to define the hashing algorithm to be used for hashing a data. For example, after the ```setHash()``` method, we can supply a list of algorithms as below

```php
$Hasher->hashFuncs(['md5', 'sha1', 'base64_encode']);
```

In the code above, each function will be used for hashing the data specified in ```setHash()``` method

#### Processing and obtaining static hashed data 

In order to execute the hashing and obtain the hash data the ```hashify()``` method is called. This method will execute and return the hashed data. 

   > Process and return hashed data
   ```php 
   $hash = $Hasher->hashify(); //process and return hash
   ```

   > The ```hashify()``` method also takes an integer parameter which makes it possible to execute the hashing in a number of specified times.
   ```php 
   $hash = $Hasher->hashify(7); //run hashing 7 times
   ```

#### Processing and obtaining dynamic hashed data 

While ```hashify()``` method returns a static hashed data by default, the returned data can be specified as dynamic through the ```randomize()``` method. This means that different hashed data will be generated when the ```hashify()``` method is called. 

   > Generate a random hash from specified data
   ```php 
   $Hasher->randomize();
   $hash = $Hasher->hashify(); 
   ```

   > Generate a random hash by using dynamic functions
   ```php 
   $Hasher->randomize(time());
   $hash = $Hasher->hashify();
   ```
   
#### Behavioural Pattern of Hashify

   > The hashify function keeps track of its last state and generates a new hash once it is recalled. This means that every time ```hashify()``` method is called, a newly hashed data is generated from its last state. For example 

   ```php 
   $hash1 = $Hasher->hashify(); //new hash one
   $hash2 = $Hasher->hashify(); //new hash two
   $hash3 = $Hasher->hashify(); //new hash three 
   $hash4 = $Hasher->hashify(0); //new hash one (reset hash)
   $hash5 = $Hasher->hashify(); //new hash two
   ```

   > In the code above, the hashify will continue to generate a new data until the hash node is restarted by supplying an argument of zero(0) to the hashify method. Once the hash node is restarted the data returned will be the first hash while the subsequent called will reflect its previous pattern. We may however try to be specific in the number of calls through the argument supplied. For example: 

   ```php 
   $hash1 = $Hasher->hashify(); //new hash one
   $hash2 = $Hasher->hashify(); //new hash two
   $hash3 = $Hasher->hashify(); //new hash three 
   
   $hash4 = $Hasher->hashify(3); //new hash three
   ```

   > In the code above the ```$hash4``` data will be recorded as the same data with ```$hash3```. This is because ```$hash3``` contains a data returned after three(3) successful calls of hashify. This data matches the exact number of times supplied as argument in the ```$hash4```. This means that rather than running the ```hashify()``` without arguments for 4 consecutive times, we can easily supply the number of specific times of hash as arguments and the corresponding data will be returned. Also, in other to prevent `hashify()` from constantly changing, the first argument supplied must be false as shown below:
   ```php 
   $hash1 $Hasher->hashify(); //new hash one
   $hash2 $Hasher->hashify(); //new hash twp
   $hash3 $Hasher->hashify(false); //same as hash one above
   ```

   > The hashify function also assumes a list of hash function which overides any default declared if an array is supplied as first argument 
   ```php 
   $hash = $Hasher->hashify(['md5', 'sha']);
   ```

   > In cases where two arguments are supplied, the first must be integer or boolean while the second array argument should contain the hashing algorithm. For example:
   ```php 
   $hash = $Hasher->hashify(false, ['md5', 'sha']);
   ```
   
#### Generate an independent random hash  

Other random hashes can be generated independently through the ```randomHash()``` method. This method is a stand alone method that does not depend on any other method to perform its functions. 

   > Generate random hash of specific length of characters 
   ```php 
   $hash = $Hasher->randomHash(10); //random hash string of 10 characters
   ``` 

   > Generate random hash of specific length using specific range of characters 
   ```php 
   $hash = $Hasher->randomHash(10, 'foo'); //random hash string of 10 characters using characters in 'foo' only
   ``` 

   > Generate random hash using specfied alogithms. Note that hash length can only be specified by the last algorithm used, hence the length is not applied.
   ```php 
   $hash = $Hasher->randomHash("", 'foo', ['md5','sha1']); //random hash of 'foo' using specified functions.
   ``` 