#include <stdio.h>
#include "prog.h"

int main(int argc, char** argv) {
    if (argc < 2) return 0;
    FILE *f = fopen(argv[1], "r");
    if (f == NULL) return 0;
    long x;
    fscanf(f, "%ld", &x);
    fclose(f);
    printf("%ld\n", foo(100, x));
    return 0;
}
