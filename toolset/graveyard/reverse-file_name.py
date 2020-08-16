import os

files = os.listdir('.')

for file in files:
    s = os.path.basename(file)
    print(s)
    l = s.split('-')
    print(l)
    l = [s.replace('.pdf', '') for s in l]
    print(l)
    r = list(reversed(l))
    print(r)
    os.rename(file, '-'.join(r) + '.pdf')

