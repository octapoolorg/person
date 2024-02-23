import subprocess

scripts = ["transform_3.py", "transform_4.py", "transform_5.py", "transform_6.py","transform_7.py"]

for script in scripts:
    process = subprocess.run(["python3", script])
    if process.returncode != 0:
        print(f"Script {script} failed with return code: {process.returncode}")
        break