###Piwik::Self-Assembly
<i>noun</i>
 1. The spontaneous formation of a body in a medium containing the appropriate components
 2. The rapid instantiation of a [Piwik](http://piwik.org/ "Piwik") Deployment Instance on IBM Bluemix containing the appropriate components.

An opinionated (a subset of marketplace plugins are automatically installed) one-click self-assembling deployment of the Piwik platform for web and traffic analytics onto a CloudFoundry platform.

#### Why?
Open source projects are awesome. PaaS CloudFoundry enabling of self-hosted application platforms is messy.  Making a mashup between cool opensource and cloud-enabling tweaks that feels sweet and simple is hard to do.  Legal review burdens aside, the level of ongoing maintenance effort is directly proportional to the number of tweaks in the mashup.  So, keeping a repository concise and abbreviated is smart.

#### How is this better than Docker?
Better is not the right question.  Sometimes a cool project may not have a high-quality Dockerfile image available yet.  Sometimes you may want to learn more about how specific runtimes and buildpacks behave within a PaaS - so what better way than to see in detail how complex apps and platforms are assembled for PaaS CloudFoundry cloud deployment.  Sometimes you feel more comfortable understanding <<fill in your favorite runtime language - PHP, Python, Node.js, ...>> than Docker CLI.  Sometimes Docker is the way better approach to go, but you like doing things the hard way.

#### How does it work?
The magic is in the pipeline.yml.  A build script is embedded which precisely defines the steps required to PaaS CloudFoundry enable the opensource application.  The script pulls code from various locations, applies tweaks and cleans itself up into a deployable asset.  Using IBM DevOps services, you may download the built asset (which can then be tweaked further and deployed manually using the CF CLI) or simply let the DevOps pipeline continue to do the assembly and deploy effort for you.  The former is useful for devs looking to innvoate and expand capabilities of the open source project (For example: adding cognitive computing interactions from something like IBM Watson) and the latter is for folks simply desiring a rapid turnkey deployment of the opensource project for end-use.

#### Why didn't you use packaging technologies like Composer, Bundler, ...?
In many cases, the deploy is using these packaging technologies to help gather dependencies.  This repository automates the organization and customization of files PRIOR to dependency inspection and installation.  For example, customization tweaks that make the web installer process smarter in self-populating bound service credentials, new feature tweaks that include service client sdks, etc ...  
