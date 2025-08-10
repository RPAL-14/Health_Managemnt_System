import pydicom
import matplotlib.pyplot as plt
import sys

if len(sys.argv) < 2:
    print("Usage: python script.py <dicom_file>")
    sys.exit(1)

ImageFile = pydicom.dcmread(sys.argv[1])
plt.imsave('./sample.png', ImageFile.pixel_array, cmap=plt.cm.bone)
print("Image converted successfully!")