---
title: "Installing NVIDIA Docker On Ubuntu 16.04"
header:
  teaser: projects/installing-nvidia-docker/docker-logo.png
categories:
  - Project
tags:
  - machine-learning
  - deep-learning
  - docker
  - nvidia
  - nvidia-docker
  - gpu
  - note
---

Hey guys, it has been quite a long while since my last blog post (for almost a year, I guess). Today, I am going to tell you about something that I wish I had known before: NVIDIA Docker.

### What is Docker? And what is NVIDIA Docker?
When you come across the term **Docker** somewhere, you may feel (just like I did) a little bit confused about what it is, and why we should consider using it.
That's totally understandable if you are just machine learning enthusiasts like I was before, which you may not need to care about managing resources, setting up development/testing/production environment or something like that.
But what if you are serious about getting a career in this field, working on some large scale projects with a team? It is likely that you and your guys will end up sharing one "bucky" supermachine (such as DGX-1), rather than using your own machine. Because of that, it will be best if you know about Docker or at least know how to use it!

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- MidPageAds -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3852793730107162"
     data-ad-slot="4068904466"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

So, what is Docker? I'm not gonna rewrite any kind of long explanation since you can get it from Docker's page. In short (which is why it may not be absolutely precise), Docker is a software which help you create a virtual Linux/Windows environment called **container**, which you can then develop and run applications on.

![what_is_container](/images/projects/installing-nvidia-docker/what_is_container.PNG)
(Image captured from Docker's page)

"Hey, isn't it what VM (Virtual Machine) does?" - You may ask. Docker containers and VMs generally can do the same thing. For instance, you want to run Windows application on Ubuntu? Well, you can use Docker to create a Windows container, and VM can do the trick as well.

To answer to the question above, please take a look at the picture below which I took from Docker's page. They even show us the difference, don't they?

![docker_vs_vm](/images/projects/installing-nvidia-docker/docker_vs_vm.PNG)
(Image captured from Docker's page)

What we can see from the picture is that, using VM requires creating a full copy of the OS for each application, whereas within Docker, many containers can share the same OS while running their own applications, which is the reason why:
* Docker takes less hard disk space
* Docker takes less RAM to operate
* Docker containers can boot within seconds
* Containerized software will always run the same, regardless of the environment

For a more detailed comparison, you can take a look at this thread on StackOverflow: [How is Docker different from VM?](https://stackoverflow.com/questions/16047306/how-is-docker-different-from-a-normal-virtual-machine){:target="_blank"}

Last, but not least, what about NVIDIA Docker???

Well, it's a pretty tedious task to get your graphic cards working on virtual machines, and the same thing happens when using Docker too. And then NVIDIA Docker, which is simply a plugin to Docker, came out and turn that task into just a piece of cake! And that's it, even the name explains itself, right?

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- MidPageAds2 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3852793730107162"
     data-ad-slot="2275566366"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

### Installing NVIDIA docker
So now you may got some idea about what Docker is, let's get into the most important part: installing NVIDIA Docker.
As I said in the previous part, NVIDIA docker is just a plugin to docker, which makes GPU accessible from inside docker's containers. Therefore, installing NVIDIA docker consists of three steps like below:
- Installing NVIDIA driver
- Installing docker
- Installing NVIDIA docker

#### Installing NVIDIA driver
NVIDIA driver is simply the necessary driver to use your GPU. You only need to install NVIDIA driver to your PC in order to use NVIDIA docker, which is a big advantage of docker.
How to install NVIDIA driver depends on what Linux distribution you are using. And NVIDIA has a very detailed step-by-step instructions for all Linux distributions, so I think I should leave this part for you guys :) It's very easy, don't panic. My one piece of advice is: the newer the driver is, the better! The reason is that, newer version of CUDA toolkit may not work with old version of NVIDIA driver.
Here is the link to the instructions: [CUDA Installation Guide](http://docs.nvidia.com/cuda/cuda-installation-guide-linux/index.html){:target="_blank"}.

#### Installing docker
Next, we will install docker. Docker has two available editions: Community Edition (CE) and Enterprise Edition (EE). And just like NVIDIA driver, you need to know what Linux distribution you are using to choose the proper installation file.
Below is the installing instructions for Docker Community Edition on Ubuntu (the OS I am using, of course).

Firstly, you need to remove (if any) old version of docker. If you can assure that this is the first time you install docker on your machine, then you can skip to the next step. Otherwise, you'd better run the following command:

```
$ sudo apt-get remove docker docker-engine docker.io
```

If docker is not installed on your machine, then apt-get will tell you that. It is totally fine.

Next, we will install docker. I recommend installing docker using the repository so that when the new version is available, you can get the update from repository easily.

To installing from repository, we need to set up the Docker repository first. As usual, you may want to update the *apt* package index:

```
$ sudo apt-get update
```

Next, install the packages to allow *apt* to use a repository through HTTPS:

```
$ sudo apt-get install \
    apt-transport-https \
    ca-certificates \
    curl \
    software-properties-common
```

Next, add the official GPG key of Docker:

```
$ curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
```

Verify that the command below print out 9DC8 5822 9FC7 DD38 854A E2D8 8D81 803C 0EBF CD88:

```
$ sudo apt-key fingerprint 0EBFCD88
```

Next, tell *apt* to use the stable repository by run the command below:

```
$ sudo add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
   $(lsb_release -cs) \
   stable"
```

At this point, we have finished set up the repository. Next, we will update the *apt* package index and install Docker CE:

```
$ sudo apt-get update && apt-get install docker-ce
```

Next, we will check if Docker is installed correctly by running the well-known hello-world Image:

```
$ sudo docker run hello-world
```

Your screen should print out something like below:

![docker-hello-world](/images/projects/installing-nvidia-docker/docker-hello-world.png)

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- MidPageAds -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3852793730107162"
     data-ad-slot="4068904466"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

#### Installing NVIDIA docker
In the next step, we will finish our job by installing NVIDIA docker, which is just a plug in of Docker to help container use the GPUs of the host machine.

First, you need to remove NVIDIA docker 1.0 (if installed):

```
docker volume ls -q -f driver=nvidia-docker | xargs -r -I{} -n1 docker ps -q -a -f volume={} | xargs -r docker rm -f
sudo apt-get purge -y nvidia-docker
```

Next, we will add the necessary repository, then update the *apt* package index:

```
curl -s -L https://nvidia.github.io/nvidia-docker/gpgkey | \
  sudo apt-key add -
curl -s -L https://nvidia.github.io/nvidia-docker/ubuntu16.04/amd64/nvidia-docker.list | \
  sudo tee /etc/apt/sources.list.d/nvidia-docker.list
sudo apt-get update
```

We are nearly there, next we will install NVIDIA docker:

```
sudo apt-get install -y nvidia-docker2
sudo pkill -SIGHUP dockerd
```

That's it. We have installed NVIDIA docker. Let's verify the installation by running the latest CUDA image, which is officially provided by NVIDIA:

```
docker run --runtime=nvidia --rm nvidia/cuda nvidia-smi
```

If this is the first time you run the command above, you might notice that Docker is trying to download something like below:

![docker-image-download](/images/projects/installing-nvidia-docker/docker-image-download.png)

Remember that Docker somehow works the same way as VM? It means that in order to create Containers, Docker first needs an Image too. And where is it getting the Image from? Well, I will make it clear in the next blog post. After the Image is downloaded and the command is executed, you will see something like that:

![nvidia-docker-test](/images/projects/installing-nvidia-docker/nvidia-docker-test.png)

The command above should print out the information of your host machine's GPU(s) (as the nvidia-smi command usually does).

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- MidPageAds2 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3852793730107162"
     data-ad-slot="2275566366"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

### Summary

Today I have introduced to you NVIDIA Docker, which I personally think that every deep learning developer should know about and get used to. And I hope you all successfully installed NVIDIA Docker. Some of you may not be convinced yet, which is why I am creating another post about some practical use cases as well as some tips on using Docker. So how do we utilize Docker to be more efficient at work? Wait for the next blog post! See you!
