<?php

// Course content configuration
$course_content = [
    // C++ Course
    'cpp' => [
        'video_id' => '8jLOx1hD3_o',
        'sections' => [
            [
                'title' => 'Introduction to C++',
                'lessons' => [
                    ['title' => 'What is C++?', 'duration' => '10:15', 'video_id' => '8jLOx1hD3_o?start=0'],
                    ['title' => 'Setting Up Environment', 'duration' => '12:30', 'video_id' => '8jLOx1hD3_o?start=615'],
                    ['title' => 'Your First C++ Program', 'duration' => '15:00', 'video_id' => '8jLOx1hD3_o?start=1230']
                ]
            ],
            [
                'title' => 'Basic Concepts',
                'lessons' => [
                    ['title' => 'Variables and Data Types', 'duration' => '20:00', 'video_id' => '8jLOx1hD3_o?start=1845'],
                    ['title' => 'Operators and Control Flow', 'duration' => '25:00', 'video_id' => '8jLOx1hD3_o?start=3045']
                ]
            ]
        ],
        'resources' => [
            ['title' => 'C++ Cheat Sheet', 'type' => 'pdf', 'icon' => 'fa-file-pdf'],
            ['title' => 'Practice Code Examples', 'type' => 'code', 'icon' => 'fa-file-code'],
            ['title' => 'Programming Exercises', 'type' => 'task', 'icon' => 'fa-tasks']
        ]
    ],

    // Java Course
    'java' => [
        'video_id' => 'eIrMbAQSU34',
        'sections' => [
            [
                'title' => 'Java Fundamentals',
                'lessons' => [
                    ['title' => 'Introduction to Java', 'duration' => '12:00', 'video_id' => 'eIrMbAQSU34?start=0'],
                    ['title' => 'Java Development Environment', 'duration' => '15:00', 'video_id' => 'eIrMbAQSU34?start=720'],
                    ['title' => 'Basic Syntax', 'duration' => '18:00', 'video_id' => 'eIrMbAQSU34?start=1620']
                ]
            ],
            [
                'title' => 'Object-Oriented Programming',
                'lessons' => [
                    ['title' => 'Classes and Objects', 'duration' => '25:00', 'video_id' => 'eIrMbAQSU34?start=2700'],
                    ['title' => 'Inheritance and Polymorphism', 'duration' => '30:00', 'video_id' => 'eIrMbAQSU34?start=4500']
                ]
            ]
        ],
        'resources' => [
            ['title' => 'Java Programming Guide', 'type' => 'pdf', 'icon' => 'fa-file-pdf'],
            ['title' => 'Source Code Repository', 'type' => 'code', 'icon' => 'fa-file-code'],
            ['title' => 'Practice Projects', 'type' => 'task', 'icon' => 'fa-tasks']
        ]
    ],

    // UI/UX Course
    'uiux' => [
        'video_id' => 'c9Wg6Cb_YlU',
        'sections' => [
            [
                'title' => 'UI/UX Fundamentals',
                'lessons' => [
                    ['title' => 'Introduction to UI/UX', 'duration' => '10:00', 'video_id' => 'c9Wg6Cb_YlU?start=0'],
                    ['title' => 'Design Principles', 'duration' => '15:00', 'video_id' => 'c9Wg6Cb_YlU?start=600'],
                    ['title' => 'User Research', 'duration' => '20:00', 'video_id' => 'c9Wg6Cb_YlU?start=1500']
                ]
            ],
            [
                'title' => 'Design Process',
                'lessons' => [
                    ['title' => 'Wireframing', 'duration' => '18:00', 'video_id' => 'c9Wg6Cb_YlU?start=2700'],
                    ['title' => 'Prototyping', 'duration' => '22:00', 'video_id' => 'c9Wg6Cb_YlU?start=3780']
                ]
            ]
        ],
        'resources' => [
            ['title' => 'UI/UX Design Guide', 'type' => 'pdf', 'icon' => 'fa-file-pdf'],
            ['title' => 'Design Assets', 'type' => 'design', 'icon' => 'fa-palette'],
            ['title' => 'Practice Projects', 'type' => 'task', 'icon' => 'fa-tasks']
        ]
    ],

    // Neural Networks Course
    'neural' => [
        'video_id' => 'VyWAvY2CF9c',
        'sections' => [
            [
                'title' => 'Neural Networks Basics',
                'lessons' => [
                    ['title' => 'Introduction to Neural Networks', 'duration' => '15:00', 'video_id' => 'VyWAvY2CF9c?start=0'],
                    ['title' => 'Perceptrons', 'duration' => '20:00', 'video_id' => 'VyWAvY2CF9c?start=900'],
                    ['title' => 'Activation Functions', 'duration' => '18:00', 'video_id' => 'VyWAvY2CF9c?start=2100']
                ]
            ],
            [
                'title' => 'Deep Learning',
                'lessons' => [
                    ['title' => 'Backpropagation', 'duration' => '25:00', 'video_id' => 'VyWAvY2CF9c?start=3300'],
                    ['title' => 'Training Neural Networks', 'duration' => '30:00', 'video_id' => 'VyWAvY2CF9c?start=4800']
                ]
            ]
        ],
        'resources' => [
            ['title' => 'Neural Networks Guide', 'type' => 'pdf', 'icon' => 'fa-file-pdf'],
            ['title' => 'Python Code Examples', 'type' => 'code', 'icon' => 'fa-file-code'],
            ['title' => 'Practice Datasets', 'type' => 'data', 'icon' => 'fa-database']
        ]
    ],

    // Motion Graphics Course
    'motion' => [
        'video_id' => 'ROw_Xnmg2W4',
        'sections' => [
            [
                'title' => 'Motion Graphics Fundamentals',
                'lessons' => [
                    ['title' => 'Introduction to Motion Graphics', 'duration' => '12:00', 'video_id' => 'ROw_Xnmg2W4?start=0'],
                    ['title' => 'Basic Animation Principles', 'duration' => '18:00', 'video_id' => 'ROw_Xnmg2W4?start=720'],
                    ['title' => 'Working with Keyframes', 'duration' => '15:00', 'video_id' => 'ROw_Xnmg2W4?start=1800']
                ]
            ],
            [
                'title' => 'Advanced Techniques',
                'lessons' => [
                    ['title' => 'Shape Animation', 'duration' => '20:00', 'video_id' => 'ROw_Xnmg2W4?start=2700'],
                    ['title' => 'Text Animation', 'duration' => '22:00', 'video_id' => 'ROw_Xnmg2W4?start=3900']
                ]
            ]
        ],
        'resources' => [
            ['title' => 'Motion Graphics Guide', 'type' => 'pdf', 'icon' => 'fa-file-pdf'],
            ['title' => 'Project Files', 'type' => 'project', 'icon' => 'fa-folder-open'],
            ['title' => 'Asset Library', 'type' => 'assets', 'icon' => 'fa-images']
        ]
    ],

    // Video Editing Course
    'video' => [
        'video_id' => 'qDHnCFMZ9HA',
        'sections' => [
            [
                'title' => 'Video Editing Basics',
                'lessons' => [
                    ['title' => 'Introduction to Video Editing', 'duration' => '10:00', 'video_id' => 'qDHnCFMZ9HA?start=0'],
                    ['title' => 'Interface Overview', 'duration' => '15:00', 'video_id' => 'qDHnCFMZ9HA?start=600'],
                    ['title' => 'Basic Editing Techniques', 'duration' => '20:00', 'video_id' => 'qDHnCFMZ9HA?start=1500']
                ]
            ],
            [
                'title' => 'Advanced Editing',
                'lessons' => [
                    ['title' => 'Transitions and Effects', 'duration' => '25:00', 'video_id' => 'qDHnCFMZ9HA?start=2700'],
                    ['title' => 'Color Correction', 'duration' => '22:00', 'video_id' => 'qDHnCFMZ9HA?start=4200']
                ]
            ]
        ],
        'resources' => [
            ['title' => 'Video Editing Manual', 'type' => 'pdf', 'icon' => 'fa-file-pdf'],
            ['title' => 'Practice Footage', 'type' => 'video', 'icon' => 'fa-film'],
            ['title' => 'Effect Presets', 'type' => 'preset', 'icon' => 'fa-sliders-h']
        ]
    ]
];

// Function to get course content by ID
function get_course_content($course_id) {
    global $course_content;
    
    // Map database course IDs to content keys
    $course_map = [
        1 => 'cpp',
        2 => 'java',
        3 => 'uiux',
        4 => 'neural',
        5 => 'motion',
        6 => 'video'
    ];
    
    $content_key = $course_map[$course_id] ?? null;
    return $content_key ? $course_content[$content_key] : null;
} 