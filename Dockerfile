FROM ubuntu:16.04
RUN apt-get update && apt-get install -y apt-transport-https ca-certificates
RUN echo "deb http://apt.llvm.org/xenial/ llvm-toolchain-xenial main" >> /etc/apt/sources.list
RUN echo "deb-src http://apt.llvm.org/xenial/ llvm-toolchain-xenial main" >> /etc/apt/sources.list
# Installing dependencies for Prophet TOOL
RUN apt-get update && apt-get install -y \
    autoconf \
    automake \
    bison \
    cmake \
    curl \
    flex \
    g++ \
    git \
    libexplain-dev \
    libtool \
    libtool-bin \
    libtinfo-dev \
    libz-dev \
    mercurial \
    nano \
    python \
    subversion \
    wget

RUN mkdir -p /llvm/llvm-361; git clone -b llvmorg-3.6.1 --single-branch https://github.com/llvm/llvm-project /llvm/llvm-361/source
RUN mv /llvm/llvm-361/source/clang /llvm/llvm-361/source/llvm/tools/clang; mv /llvm/llvm-361/source/compiler-rt /llvm/llvm-361/source/llvm/projects/compiler-rt
RUN mkdir /llvm/llvm-361/build; cd /llvm/llvm-361/build; cmake ../source/llvm -DCMAKE_BUILD_TYPE=Release -DCMAKE_ENABLE_ASSERTIONS=OFF -DLLVM_ENABLE_WERROR=OFF -DCMAKE_CXX_FLAGS="-std=c++11"
RUN cd /llvm/llvm-361/build; make -j32; make install
ADD . /prophet-gpl
RUN cd /prophet-gpl;autoreconf -i;
RUN cd /prophet-gpl;CC=clang CXX=clang++ ./configure --host=x86_64 --build=x86_64 --enable-shared
RUN sed -i -e '456d' /prophet-gpl/benchmarks/php-deps/Makefile
RUN sed -i 's/lighttpd-deps//g' /prophet-gpl/benchmarks/Makefile
RUN sed -i 's/benchmarks//g' /prophet-gpl/Makefile
RUN sed -i 's/tests//g' /prophet-gpl/Makefile
RUN cd /prophet-gpl;make CFLAGS='-Wno-error' CXXFLAGS='-Wno-error -fno-rtti' -j64
ENV LIBRARY_PATH=/prophet-gpl/src/.libs
ENV LD_LIBRARY_PATH=/prophet-gpl/src/.libs
RUN cd $LIBRARY_PATH && ar -x libprofile_runtime.a && gcc -shared _prophet_profile.o -o libprofile_runtime.so && \
    ln -s libprofile_runtime.so libprofile_runtime.so.0 && rm _prophet_profile.o
# Run cd $LIBRARY_PATH && ar -x libtest_runtime.a && gcc -shared _test_runtime.o -o libtest_runtime.so && \
#     ln -s libtest_runtime.so libtest_runtime.so.0 && rm _test_runtime.o
RUN cd $LIBRARY_PATH && ar -x libprofiler.a && gcc -shared ProfilerAction.o -o libprofiler.so && \
    ln -s libprofiler.so libprofiler.so.0 && rm ProfilerAction.o
RUN ln -s /prophet-gpl/src/prophet /usr/bin/prophet
