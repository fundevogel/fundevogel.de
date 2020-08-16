import glob
import os
import shutil

files = glob.glob('./*/*/**.txt')

print(files)

for file in files:
    name = os.path.basename(os.path.dirname(file))
    name = name[4:].replace('-', '')
    os.mkdir('./' + name)
    shutil.move(file, './' + name + '/calendar.event.de.txt')
