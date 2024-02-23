import subprocess

scripts = ["extract.py", "transform.py", "load.py"]

open("nohup.out", "w").close()

for script in scripts:
    process = subprocess.run(["python3", script])
    if process.returncode != 0:
        print(f"Script {script} failed with return code: {process.returncode}")
        break