<?php

namespace App\Livewire\SiliconValley;

use App\Facades\LandingPagePatch;
use Livewire\Component;

class AzBlock extends Component
{
    public $lp_data,$title,$techjson = [];
    public $successMessage = '';
    public $errorMessage = '';

    public function mount($lp_data)
    {
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $jsonData = isset($lp_data['page_contect']) ? json_decode($lp_data['page_contect'],true) : [];
        $az_block = $jsonData['az_block'] ?? [];
        $this->title = $az_block['title'] ?? 'Whatever You Envision We Have { A To Z } Ready For You';
        $this->techjson = [
                "A"=> ["AI", "Angular", "AWS", "Ansible", "Android", "Apache Kafka", "AR", "ASP.NET", "Azure"],
                "B"=> ["Bootstrap", "BigQuery", "Bitbucket", "Blazor", "Blockchain", "Bash", "BLoC"],
                "C"=> ["C", "C++", "C#", "CSS", "CI/CD", "Cloudflare", "ClickHouse", "CouchDB", "Cypress"],
                "D"=> ["Dart", "Django", "Docker", "D3.js", "Deno", "DigitalOcean", "DataDog"],
                "E"=> ["Elasticsearch", "Express.js", "EC2", "Electron", "EKS", "Ember.js", "Ethereum"],
                "F"=> ["Firebase", "FastAPI", "Flutter", "Figma", "Flask", "F#", "Fortinet"],
                "G"=> ["Git", "GitHub", "GitLab", "GraphQL", "Go", "GCP", "Gradle", "Gatsby"],
                "H"=> ["HTML", "Hadoop", "Heroku", "Helm", "Haskell", "Hyperledger"],
                "I"=> ["Ionic", "Istio", "IBM Cloud", "IntelliJ IDEA", "IoT"],
                "J"=> ["Java", "JavaScript", "Jenkins", "Jest", "JIRA", "jQuery", "JSON", "Jupyter"],
                "K"=> ["Kubernetes", "Kotlin", "Kibana", "Kafka", "Keycloak"],
                "L"=> ["Laravel", "Linux", "LangChain", "LLVM", "Lightsail", "LAMP Stack"],
                "M"=> ["MongoDB", "MySQL", "Microsoft Azure", "Material UI", "Memcached", "ML", "MATLAB"],
                "N"=> ["Node.js", "Nginx", "Next.js", "NestJS", "Netlify", "Numpy"],
                "O"=> ["OpenAI", "OpenCV", "OpenShift", "OAuth", "Oracle Cloud", "Objective-C"],
                "P"=> ["Python", "PHP", "PostgreSQL", "Power BI", "Pandas", "PyTorch", "Prometheus"],
                "Q"=> ["Qt", "Qlik", "Quarkus", "QEMU"],
                "R"=> ["React", "Redux", "Ruby", "Rust", "REST API", "R", "Redis", "RabbitMQ"],
                "S"=> ["SQL", "SQLite", "Spring Boot", "Swift", "Selenium", "SASS", "Spark", "Stripe"],
                "T"=> ["TypeScript", "Terraform", "Tailwind CSS", "Tableau", "TensorFlow", "Twilio", "Tauri"],
                "U"=> ["Unity", "Unreal Engine", "Ubuntu", "UEFI", "UI/UX Design", "Umbraco"],
                "V"=> ["Vue.js", "Vite", "Visual Studio", "Vercel", "Vault", "VMWare"],
                "W"=> ["WordPress", "Webpack", "Web3.js", "WooCommerce", "WebRTC", "WSL"],
                "X"=> ["XML", "Xamarin", "Xcode", "XAMPP"],
                "Y"=> ["YAML", "Yarn", "Yocto Project", "YubiKey"],
                "Z"=> ["Zabbix", "Zookeeper", "Zapier", "Zod"]
            ];
    }

    public function save()
    {
        try {
            //code...
            $this->validate([
                'title' => 'required|max:255',
            ]);

            $contentdata = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];

            $contentdata['az_block'] = [
                'title' => $this->title,
            ];

            LandingPagePatch::update($this->lp_data,$contentdata);
            
            $this->successMessage = 'section updated successfully!';
        } catch (\Throwable $th) {
            //throw $th;
            $this->errorMessage = $th->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.silicon-valley.az-block');
    }
}
