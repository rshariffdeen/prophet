# 1. Replication Package Overview

This replication package contains the necessary files to reproduce the results
of the POPL paper ``Automatic Patch Generation by Learning Correct Code''. 
Our paper presents Prophet, a novel patch generation system that uses the staged 
condition synthesis technique. The replication package provides a way to reproduce 
all of our experiments with Prophet. It contains the following components:

1) A public AMI image for reproducing all of our experiments except fbc.

    Region: US East
    AMI id: ami-9c69068b
    AMI name: prophet-replication-0.3
    
2) A public AMI image for reproducing the remaining fbc experiments

	Region: US East
	AMI id: ami-ac7e11bb
	AMI name: prophet-replication-32bit-0.3

3) Scenario tarballs that contain necessary files to reproduce each of the defects
in our experiments.

    http://rhino.csail.mit.edu/spr-rep/scenarios/

4) Prophet generated patches for the benchmark defects:

    http://rhino.csail.mit.edu/prophet-rep/prophet-result/

Note that all Prophet source code in the AMI image of the replication package is licensed under GPLv3.

## 1.1 Consistency and Completeness

A user can use the replication package to reproduce all of our Prophet experiments
we performed in the paper. Specifically, the replication package is able to 
reproduce all results in Figure 10, Figure 11, and Figure 12 in the paper. 
Note that the results of GenProg and AE are obtained from previous work.

The results obtained from the replication package will be in general consistent
with the reported results in the paper. For each defect for which we
claim, in the paper, that Prophet generates a plausible or correct patch,
the user can use the replication package to obtain the same patch. 

## 1.2 Ease of Reuse

Program defects often require specific environment setup to reproduce. To
facilitate the reproduction we packed our systems into AMI images and our
benchmark defects into scenario tarballs. We also provide script to facilitate
the generation of every number in Figure 10, Figure 11, and Figure 12. Note that our
experiments include manual analysis of the generated patches to identify
whether the patch is correct or not. We provide descriptions for each Prophet
generated correct patches. 

## 1.3 Potential to Facilitate Future Research

One benefit to the future research is that Prophet in this replication package can
be used as the baseline system for the future research. As all the source code
of Prophet is available inside the provided AMI images, researcher who want to build
new patch generation systems can build their systems on top of Prophet and reuse
(part of) the Prophet source code.

Another benefit to the future research in the field is that the benchmark
scenario tarballs in the replication package provide useful infrastructures
(test cases and scripts) to evaluate future patch generation systems. Note that
Prophet is evaluated on the GenProg 2012 benchmark set and we fixed several
known issues in the original GenProg 2012 infrastructure.

## 1.4 Quality of the Documentation

Section 2 provides step-by-step instructions of reproducing Prophet experiments
with this replication package. Section 3 describes our manual analysis of each
correct Prophet patch. Section 4 describes how to apply Prophet to new defects if
desired. We recommend the user of this replication package starts with the 
step-by-step instructions in Section 2.

# 2. Reproduce Prophet Experiments


In this replication package, we provide AMI images of our Amazon EC2 experiment environment. We evaluated 105 defects/changes in the GenProg 2012 benchmark set. Due to the disk space limit, we cannot package all of the defects/changes into the AMI images. Instead, we separately provide a scenario tarball for each
defect/change we evaluated in our experiments. 

We next provide a step by step instructions of running Prophet to generate patches
for the php defect php-309579-309580. Our experiments on other defects can be
reproduced similarly. The recommended instance types are m3.large for the 64-bit image and m1.medium for the 32-bit image (which we performed our experiments). 
It may be possible to run php-309579-309580 at the free-tier instance type t2.micro, but it will need a few hours to finish. The reproducibility of other defects are not guaranteed on t2.micro.

## 2.1 Step-by-Step Instruction of Reproducing php-309579-309580

  (1) Launch an m3.large instance in US.East with our AMI "ami-9c69068b"
  
    a) Go to the website: http://aws.amazon.com/ec2
    b) Login with your account.
    c) Click on Compute/EC2 to go to the EC2 Dashboard
    d) If necessary, change your region to US East (N. Virginia) (upper right button)
    e) Click "Instances" (left bar). 
    f) Click Launch Instance
    g) Click Community AMIs (left bar), and search for ami-9c69068b
    h) It should have name "prophet-replication-0.2". Click "Select"
       Note that if you do not find the image, make sure you changed your region to US East and try again.
    i) Select "m3.large" instance type. Click "Review and Launch". Click "Launch"
    j) In the pop-up window, you may need to create a new private key file. 
       Assume the key you created/downloaded is at ~/popl.pem.
    k) View Instances
    l) In your local Unix shell on your machine (not Amazon), go to your local directory ~
       type chmod 400 popl.pem to silent permission complaints.
    m) In the "instances" of the EC2 Dashboard, click "Connect" for the new started instance. 
       The only purpose is to get the ip address of the new instance. 
       You will get the ip address of the new instance.
       Close
    n) Suppose the ip is "52.1.162.191". 
       From your local terminal in directory ~, type ssh -i popl.pem ubuntu@52.1.162.191 in the terminal.

  (2) Go to the directory ~/Workspace/prophet/build/tests. 
      Type "cd ~/Workspace/prophet/build/tests" in the terminal.

  (3) Run "../../tests/scripts/reproduce.py --prophet php-309579-309580" to reproduce thephp-309579-309580 case with prophet. This case takes approximately 70 minutes to complete. 
  
This script automatically downloads the corresponding scenario tarball
from our server (if not downloaded before), untars the tarball and runs Prophet on the defect scenario. For php-309579-309580, the untared directory php-case-2adf58 contains all files of the scenario. 2adf58 is the revision number of the php case from github repository. For some applications, we use different repository systems than the GenProg 2012 paper because old repository systems are often maintained anymore.

If you want to reproduce the experiment of running SPR instead of Prophet. Run:

        "../../tests/scripts/reproduce.py php-309579-309580"

If you want to reproduce the experiment of running random algorithm. Run:

		"../../tests/scripts/reproduce.py --random php-309579-309580"

If you want to reproduce the experiment of running the baseline algorithm. Run:

		"../../tests/scripts/reproduce.py --baseline php-309579-309580"

If you want to reproduce the experiment of running Prophet with modification features only. Run:

		"../../tests/scripts/reproduce.py --no-sema php-309579-309580"
		
If you want to reproduce the experiment of running Prophet with program value features only. Run:

		"../../tests/scripts/reproduce.py --no-mod php-309579-309580"

Note that SSH connection may break because the script runs for a long
time. If that happens, you may lose your connection to the running
session. In the AMI we have tmux installed. You can use tmux to open a
terminal before running the script to avoid this problem.

  (4) The produced php-fix-2adf58XXX.c is the generated patch file, 
      where XXX is the filename of the original source file to be modified.

  (5) At the end of the script, it will print time information.
The time is used to compute the ``Time'' column in Figure 11.

  (6) For the 19 defects that the search space of Prophet/SPR contains at least one correct patch, we manually identify the correct patch in our experiments.
To obtain the position of the correct patches in the search space. We
wrote scripts to dump the Prophet ranked search space and parse the 
dumped search space.

Run "../../tests/scripts/reproduce.py --compare-space --prophet php-309579-309580". You will see a line like: 

	Score AAAA Rank XXX/YYY Schema BBBB Ratio ZZZZ
	
YYY is the total number of candidates in the search space, which corresponds to the "Search Space" column in Figure 12. XXX is the first correct patch rank given by Prophet, which corresponds to "First Correct Patch Rank Prophet" column in Figure 12. 

You can pass different flags to compute the first correct patch rank of different algorithms as well. For example, "../../tests/scripts/reproduce.py --compare-space --no-sema php-309579-309580" correponds to the first correct rank given by Prophet if we trun off the program value features. These numbers are also used to compute the mean rank ratios in Figure 11. Note that we are keep improving the Prophet system, the search space numbers and the running time may be slightly different than the number in the submission.

  (7) Passing flag "--full-dump" to the script will continously run Prophet (or other systems) exhaustively. For example, "../../tests/scripts/reproduce.py --full-dump --prophet php-309579-309580" will run Prophet on php-309579-309580 exhaustively.

  (8) It is similar to replicate the rest of cases in the benchmark set.
      Just replace "php-309579-309580" in the above commands with other case
      id. Run "../../tests/scripts/reproduce.py" without any argument will
      print out all of the case ids. Section 4 of this README contains general
      instructions about how to apply Prophet to other applications and defects.

  (9) All generated fix are checked against all negative and positive test cases by automated scripts. For example, the php-309579-309580 fix is checked
with ~/Workspace/prophet/tools/php-test.py. Inside the php-test.py it invokes
run-test.php. Unlike GenProg, our test script for php checks not only the exit code but also the output of the execution. If you want to manually test the generated fix for php-309579-309580, inside AMI you can:

    a) Make sure the current directory is ~/Workspace/prophet/build/tests, and you have run the reproduce script in previous steps to generate patches for php-309579-309580.
    b) Replace php-case-2adf58/php-2adf58-workdir/src/ext/date/php_date.c with the generated fix file. The name of this fix file is php fix-2adf58ext_date_php_date.c in our example.
      
         "cp php-fix-2adf58ext_date_php_date.c php-case-2adf58/php-2adf58-workdir/src/ext/date/php_date.c"
         
	c) "cd php-case-2adf58/php-2adf58-workdir/src" and "make"
	d) The newly built php binary sits in:

          "~/Workspace/prophet/build/tests/php-case-2adf58/php-2adf58-workdir/src/sapi/cli/php"
          
	To test the negative case, type in:
  
          "./sapi/cli/php run-tests.php -p ./sapi/cli/php ../tests/03996.phpt"
  
	You should see output indicating that the test case passed. 
  
	In the file ../../php-2adf58.revlog, you will find the ids for the positive
	and negative test cases. For php, all cases have a five digit id. Edit the
	../../php-2adf58.revlog file and find the id 00051 for positive cases. 
  
          "./sapi/cli/php run-tests.php -p ./sapi/cli/php ../tests/00051.phpt"

	Again, you should see that the tests pass. 

  (10) To avoid additional costs, you need to terminate the instance once you
  have done with replication. You may also need to delete volumes that used by
  the instance after its termination. 

## 2.2 fbc Experiments

The instructions above applies also to the fbc experiments. The only difference
is that at the step (1) you need to start the provided 32-bit image instead
of the 64-bit image. For fbc experiments:

(1) Launch the 32-bit AMI image, follow the same instruction but use the image ami-ac7e11bb with instance type m1.medium.
    
(2)-(10) Same as the instructions in Section 2.1. There are three fbc cases
"fbc-5251-5252", "fbc-5458-5459", and "fbc-5556-5557".

## 2.3 Training

The above experiments operate with already trained model, whose parameters are specified in "~/Workspace/prophet/crawler/" with file names "para-XXX.out" or "para-YYY-XXX.out". XXX corresponds to application that is excluded from the
training phase. YYY corresponds to the special configurations such as no program value features (no-sema) or no modification features (no-mod).

We providied scripts to reproduce the training phase as well. You can follow the following instructions to rerun the training phase:

(1) Launch the 64-bit AMI image with a m3.large or m4.large instance.
(2) "cd ~/Workspace/prophet/crawler"
(3) Run "./learn.py". It will rerun all feature extraction and training steps and generate "para-all.out", "para-php.out", etc.. It takes approximately 30 minutes.
(4) You can also run "./learn.py --no-mod" or "./learn.py --no-sema" to generate parameter files with special configurations (no program value features or no modification features).

## 2.4 Known issues

The current Prophet/SPR implementation fails to run on six cases in the GenProg 2012 benchmark set: php-308046-308051, libtiff-ed4969a-8a184dc, python-69831-69833, wireshark-35419-35414, wireshark-37171-37170, and wireshark-37190-37191. Note that we report that Prophet and SPR generate no patch for these defects in our paper. 

The plausible (but incorrect) patch Prophet generates for python-70019-70023 is compiler 
dependent and possibly machine dependent. The patch attempts to get around the test case
via messing with memory library calls. Its behavior is therefore highly dependent on the
underlying implementation of the memory routine it links to. It is known that the binary 
generated during Prophet repair process can pass the test case in Amazon EC2 (via clang compiler);
however, the binary generated by gcc compiler cannot pass the test case. Thanks to 
Alex Zhikhartsev for reporting this.

# 3. Prophet Correct Patches

Prophet generates correct patches for 15 defects. For each defect, we provide an
url that contains the developer patch and we either identifies the Prophet patch is semantically equivalent to the developer patch or provides a brief analysis for
why the Prophet patch is correct.

1) php-307562-307561

	The developer patch:
	https://github.com/php/php-src/commit/f455f8
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/php-307562-307561/php-fix-f455f8%5e1-f455f8ext_dom_document.c

Analysis:
The Prophet generated patch is identical to the developer patch. Note that this is
a regression that occurs in the repository. The reference correct revision
occurs before the buggy revision.

2) php-307846-307853

	The developer patch:
	https://github.com/php/php-src/commit/1e91069
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/php-307846-307853/php-fix-1e91069ext_date_php_date.c

Analysis:
The Prophet generated patch is identical to the developer patch.

3) php-308734-308761

	The developer patch:
	https://github.com/php/php-src/commit/1d984a7
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/php-308734-308761/php-fix-1d984a7ext_tokenizer_tokenizer.c

Analysis:
The statement order of the developer patch is slightly different from that of
the Prophet generated patch, but two patches are semantically equivalent at high
level.

4) php-309516-309535

	The developer patch:
	https://github.com/php/php-src/commit/991ba131
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/php-309516-309535/php-fix-991ba131ext_date_php_date.c

Analysis:
The Prophet generated patch is identical to the developer patch.

5) php-309579-309580

	The developer patch:
	https://github.com/php/php-src/commit/2adf58c
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/php-309579-309580/php-fix-2adf58ext_date_php_date.c

Analysis:
The Prophet generated patch is semantically equivalent to the developer patch, because when isostr == 0, isostr_len is always 0 at the modified program point.


6) php-309892-309910

	The developer patch:
	https://github.com/php/php-src/commit/5a8c917
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/php-309892-309910/php-fix-5a8c917ext_standard_string.c

Analysis:
The developer patch removes an if statement block. The Prophet generated patch
conjoins the branch condition of the if statement with 0, which effectively
nullifies the whole if statement block. Two patches are semantically
equivalent. 

7) php-310991-310999

	The developer patch:
	https://github.com/php/php-src/commit/8ba00176
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/php-310991-310999/php-fix-8ba00176Zend_zend_compile.c

Analysis:
The developer patch changes an if statement condition from (A || (B && C)) to
((A || B) && C). The Prophet patch changes the condition to ((A || (B && C)) && C), which is semantically equivalent to the developer patch.

8) php-311346-311348

	The developer patch:
	https://github.com/php/php-src/commit/1056c57f
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/php-311346-311348/php-fix-1056c57fext_standard_url_scanner_ex.c

Analysis:
The functionality of the developer patched code is that if "ctx->buf.len"
(which holds the length of "ctx->buf") is not zero, then "handled_output" is
assigned as the concatenation of "ctx->buf" and "output"; otherwise
"handled_output" is assigned as the "output". When "ctx->buf.len" is zero, the
code in the then branch has the same effect as the else branch since the string
"ctx->buf" is empty. So the Prophet patch, which eliminates the condition and lets
the program always do the then branch, is also correct.

9) libtiff-ee2ce5b7-b5691a5a

	The developer patch:
	https://github.com/vadz/libtiff/commit/eec7ec0
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/libtiff-ee2ce5b7-b5691a5a/libtiff-fix-tests-eec7ec0tools_tiff2pdf.c

Analysis:
The Prophet patch is identical to the developer patch.

10) gmp-13420-13421

	The developer patch:
	https://gmplib.org/repo/gmp/rev/131005cc271b
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/gmp-13420-13421/gmp-fix-13421mpn_generic_powm.c

Analysis:
The developer patch removes the variable "b2p" and the assignment statement
"b2p = tp + 2 * n". It then replaces every occurrence or "b2p" to "rp". The Prophet patch simply changes the assignment "b2p = tp + 2 * n" to "b2p = rp", which is semantically equivalent to the developer patch at high level.

11) gzip-a1d3d4019d-f17cbd13a1

	The developer patch:
	http://git.savannah.gnu.org/cgit/gzip.git/commit/?id=f17cbd13a1d0a7
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/gzip-a1d3d4019d-f17cbd13a1/gzip-fix-f17cbd13a1d0a7gzip.c

Analysis:
Both the developer patch and the Prophet patch inserts an assignment statement to
initialize the variable "ifd" to 0. Two patches are semantically equivalent at
high level.

12) php-307914-307915

	The developer patch:
	https://github.com/php/php-src/commit/09273098521913a
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/php-307914-307915/php-fix-09273098521913aext_phar_phar.c

Analysis:
The developer patch and the Prophet patch are identical.

13) php-308262-308315

	The developer patch:
	https://github.com/php/php-src/commit/b84967d
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/php-308262-308315/php-fix-b84967dZend_zend_execute.c

Analysis:
The developer patch and the Prophet patch are identical.

14) fbc-5458-5459

	The developer patch:
	http://fbc.svn.sourceforge.net/viewvc/fbc/trunk/FreeBASIC/src/rtlib/libfb_str_midassign.c?r1=5459&r2=5458&pathrev=5459
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/fbc-5458-5459/fbc-fix-5459fbc-src_src_rtlib_libfb_str_midassign.c
	
Analysis:
Although the developer patch changed (len < 1) to (len < 0), "len" will never be zero inside the if block after the patch. Therefore two patches are semantically equivalent.

15) libtiff-d13be72c-ccadf48a

	The developer patch:
	https://github.com/vadz/libtiff/commit/3edb9cd
	The Prophet correct patches:
	http://rhino.csail.mit.edu/prophet-rep/prophet-result/libtiff-d13be72c-ccadf48a/libtiff-fix-tests2-3edb9cdlibtiff_tif_dirread.c
	
Analysis:
The developer patch changes (td->td_nstrips > 1) to (td->td_nstrips > 2), while the Prophet patch appends an additional clause (&& td->td_nstrips != 2). Two patches are equivalent.

## 3.1 Other correct patches in space

There are other four defects for which the correct patches are inside the search space.

a) php-309688-309716: https://github.com/php/php-src/commit/3acdca

b) php-310011-310050: https://github.com/php/php-src/commit/efcb9a71

c) php-309111-309159: https://github.com/php/php-src/commit/ee83270

For this defect, the correct patch in space is: 

http://rhino.csail.mit.edu/prophet-rep/prophet-result/php-309111-309159/php-fix-ee83270ext_standard_url.c-8

d) libtiff-5b02179-3dfb33b: https://github.com/vadz/libtiff/commit/2e42d63f

# 4. How to Run Prophet in New Environments? (New Applications/Defects)

Defects often require specific environments to reproduce. We strongly recommend
any user of this replication package to reproduce our experiments via provided
AMI images with the above instructions. However, Prophet is able to apply
to other UNIX like environments, other applications, and other defects. Here 
are general instructions about how to do so:

0) The application needs to be able to build with both gcc and clang. Prophet uses
clang to run its error localization algorithm. It requires llvm and clang 3.6.1.

1) Write a script that builds the application. See, for example,
~/Workspace/prophet/tools/fbc-build.py in the Prophet AMI image is the script for
building fbc. 

2) Write another script that tests the application. See, for example,
~/Workspace/prophet/tools/fbc-test.py in the Prophet AMI. The script takes the
built src directory, the testcase directory if any, and a set of testcase ids.
It outputs the list of passed testcase ids.

3) Write or generate a log file that specifies the testcase ids of the positive
testcase set and the testcase ids of the negative testcase set. See, for
example, if you untar the scenario fbc-5458-5459 (fbc-5459.tar.gz), you can
find the log file for the scenario at
~/Workspace/prophet/build/tests/fbc-case-5459/fbc-5459.revlog in Prophet 32-bit AMI.

4) Write a configuration file that specifies:

  	a) the location of the scripts
  	b) the source location of the application
  	c) the location of the test cases
  	d) the location of the log file that specifies negative and positive testcases
  	e) add a line "localizer=profile" to enable error localizer
  	
See, for example, if you untar the scenario fbc-5458-5459 (fbc-5459.tar.gz), you can find the configuration file of the scenario at: ~/Workspace/prophet/build/tests/fbc-case-5459/fbc-5459.conf in Prophet 32-bit AMI.

5) Invoke Prophet with the configuration file: for example, you can call:

	../src/prophet -feature-para ../../crawler/para-all.out ~/Workspace/prophet/build/tests/fbc-case-5459/fbc-5459.conf -first-n-loc 200 -consider-all

to run Prophet. Note that "-feature-para ../../crawler/para-all.out" specifies the file ("../../crawler/para-all.out") that contains learned feature parameter of the model. 

When you run it in this way, Prophet will create a temporary workdir. You can
specify the workdir name and make the workdir permanent. 
You can run initialization step first by invoking:

	../src/prophet ~/Workspace/prophet/build/tests/fbc-case-5459/fbc-5459.conf -r workdir -init-only

Prophet will create a directory called "workdir" to hold all results after initialization. 

Then after initialization you can call

	../src/prophet -feature-para ../../crawler/para-all.out -r workdir -skip-verify -first-n-loc 200 -consider-all

to run Prophet.

 	a) skip-verify flag tells Prophet to skip initialization step 
 	b) first-n-loc and consider-all flags tell Prophet to consider all source files and modify the first 200 statements returned by the error localization.

The benefit of having a working directory is that you can avoid running error
localization algorithm and testcase verification again.
